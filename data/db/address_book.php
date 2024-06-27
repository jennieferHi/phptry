<?php
require __DIR__ . '/../../parts/db_connect.php';
class Address_book 
{
    protected $perPage; 
    protected $pdo;
    public function __construct()
    { 
        $this->perPage = 10;
        global $pdo; // 使用全局變數 $pdo，來自於 connect.php
        $this->pdo = $pdo;
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
    public function select($page = 1)
    {
        // 調用 totalPage 方法獲取總頁數
        $totalPageResult = $this->totalPage($page);
        
        // 將 JSON 字串解析為陣列
        $totalPageData = json_decode($totalPageResult, true);

        // 獲取總頁數
        $totalPages = isset($totalPageData['TotalPage']) ? $totalPageData['TotalPage'] : 1;

        // 查詢資料庫
        global $pdo;
        $sql = sprintf("SELECT * FROM address_book ORDER BY sid DESC
                       LIMIT %s, %s", ($page - 1) * $this->perPage, $this->perPage);
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll();

        // 返回 JSON 格式的結果
        return json_encode(array(
            "success" => 200,
            "result" => $rows,
            "totalPages" => $totalPages
        ));
    }
    public function editSelect($sid = 1)
    {
        // 調用 totalPage 方法獲取總頁數
        
        $sql = sprintf("SELECT * FROM address_book where sid=?");
        $stmt = $this->pdo->prepare($sql);  
        $stmt->execute([$sid]); 
        $rows = $stmt->fetchAll();

        // 返回 JSON 格式的結果
        return json_encode(array(
            "success" => 200,
            "result" => $rows[0]
        ));
    } 
    public function edit($sid,$name, $email, $mobile, $birthday, $address){
        
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
      $sql = "UPDATE `address_book` SET 
  `name`=?,
  `email`=?,
  `mobile`=?,
  `birthday`=?,
  `address`=?
  WHERE sid=? ";
      $stmt = $this->pdo->prepare($sql); 
      try {
        $stmt->execute([
          $_POST['name'],
          $_POST['email'],
          $_POST['mobile'],
          $birthday,
          $_POST['address'],
          $sid
        ]);
      } catch(PDOException $e) {
        $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
      }
      $output['success'] = boolval($stmt->rowCount()); 
      $output['lastInsertId'] = $this->pdo->lastInsertId();  // 取得最新建立資料的 PK    
      return  $output ;

  }
    
    public  function totalPage($page = 1)
    {
        global $pdo;
        $t_sql = "SELECT COUNT(1) FROM address_book";
        $row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);
        $totalRows = $row[0]; // 取得總筆數
        $totalPages = 10; // 預設值
        $successCode = 200;

        if ($totalRows > 0) {
            $totalPages = ceil($totalRows / $this->perPage); // 計算總頁數

            if ($page > $totalPages) {
                // 超過最大頁數時重導向到最後一頁
                header('Location: ?page=' . $totalPages);
                exit;
            }

            // 返回 JSON 格式的結果
            return json_encode(array(
                "TotalPage" => $totalPages,
                "success" => $successCode
            ));
        }

        // 如果沒有資料，返回一個錯誤或空數據結構
        return json_encode(array(
            "TotalPage" => 1, // 預設總頁數為 1
            "success" => $successCode
        ));
   
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
