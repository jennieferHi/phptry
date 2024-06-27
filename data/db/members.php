<?php
require __DIR__ . '/../../parts/db_connect.php';
class Members 
{
  protected $pdo;
  private $username;
  private $loggedIn = false;
    public function __construct()
    {  
      global $pdo; // 使用全局變數 $pdo，來自於 connect.php
      $this->pdo = $pdo;
      $this->init();
 
  }
  public function init(){ 
    if (isset($_SESSION['email'])) {
      $this->username = $_SESSION['email'];
      $this->loggedIn = true;
  }
  }
    public function create($name, $email, $mobile, $birthday, $address){
        
        $formData = [
          "name" => $this->cleanInput($name),
          "email" =>$this-> cleanInput($email),
          "mobile" => $this->cleanInput( $mobile),
          "birthday" => $this-> cleanInput($birthday),
          "address" => $this-> cleanInput( $address) 
      ]; 
        $output = [
            "success" => false,
            "error" => "",
            "code" => 0,
            "postData" => $formData, // Capture raw POST data
            "errors" => [],
          ];


        # 如果沒有值就設定為空值 null 
        $output["postData"]=$formData;  
        $birthday = empty( $formData['birthday']) ? null :  $formData['birthday'];
        $birthday = $this->birthday($birthday);
        $sql = "INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES (?, ?, ?, ?, ?, NOW() )";
        $stmt = $this->pdo->prepare($sql); 
        try {
          $stmt->execute([
            $formData['name'],
            $formData['email'],
            $formData['mobile'],
            $birthday,
            $formData['address'],
          ]);
          
        } catch(PDOException $e) {
          $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
        }
        $output['success'] = boolval($stmt->rowCount()); 
        $output['lastInsertId'] = $this->pdo->lastInsertId();  // 取得最新建立資料的 PK    
        return  $output ;

    }
    public function login($email, $password) 
    {  
      $email=$this->cleanInput($email);
      $password = $this->cleanInput($password);
      $output = [
        "success" => false, 
        "postData" => $_POST,
        "code" => 0,
        "error" => '',
      ];
      if(empty($email) or empty($password)){
        # 欄位資料不足
        $output['code'] = 401;
        echo json_encode($output);
        exit;
      }
        // 查詢資料庫
        global $pdo;
        $sql = sprintf("SELECT * FROM members where email=?");
        $stmt = $this->pdo->prepare($sql);  
      
        try {
          $stmt->execute([$email]); 
          $rows = $stmt->fetchAll();   
        } catch(PDOException $e) {
          $output['code'] = 500; //  資料庫錯誤 
          $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
        }
  
        if(empty($rows)){
          # 帳號是錯的
          $output['code'] = 403;
          echo json_encode($output);
          exit;
        };
        // 檢查密碼是否正確 
        $output['success'] = password_verify($password,  $rows[0]['password']);
        // 返回 JSON 格式的結果
        if($output['success']){
          $_SESSION['admin'] = [
            'id' => $rows[0]['id'],
            'email' => $rows[0]['email'],
            'nickname' => $rows[0]['nickname'],
          ];
        } else {
          # 密碼是錯的
          $output['code'] = 405;
          echo json_encode($output);
          exit;
        } 
         return $output;
  }   
    public function isLoggedIn() {
      return $this->loggedIn;
  } 
    private   function cleanInput($data) {
        // 清除前後空白
          $data = trim($data);
          // 清除反協槓\
          $data = stripslashes($data);
          // 特殊自轉換html 防XSS
          $data = htmlspecialchars($data);
          return $data;
      }
      private function birthday($data){
        $birthday = strtotime($data); # 轉換為 timestamp
        if($birthday===false){
          $birthday = null;
        } else {
          $birthday = date('Y-m-d', $birthday);
        }
        return $birthday;
      }
 
}
