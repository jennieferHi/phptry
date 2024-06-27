<?php 

// require __DIR__ . '/parts/db_connect.php';
require __DIR__ . '/data/db/address_book.php';
$pageName = 'list';
$title = '列表'; 
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
 
if ($page < 1) { 
  // redirect
  header('Location: ?page=1');
  exit;
}

$address_book = new Address_book();
$total = $address_book->select($page); 
// 解碼 JSON 數據
$result = json_decode($total, true);

// 檢查成功代碼並進行相應處理
if ($result['success'] == 403) {
    header('Location: ?page=1');
    exit; // 重定向後終止腳本執行
} else if ($result['success'] == 200) {
    $pageTotal = $result["totalPages"];
    $resultData = $result['result'];
    // 接下來你可以在 $resultData 中處理返回的數據
}

?>
<?php include __DIR__ . '/parts/html-head.php'  ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
 
<!--  -->
<div class="container">
<div class="row">
    <div class="col">
      <nav aria-label="Page navigation example">
        <ul class="pagination">

          <li class="page-item">
            <a class="page-link" href="?page=1">
              <i class="fa-solid fa-angles-left"></i>
            </a>
          </li>

          <li class="page-item">
            <a class="page-link" href="?page=<?=$page-1?>">
              <i class="fa-solid fa-angle-left"></i>
            </a>
          </li>
 
          <?php for ($i = $page  - 5; $i <= $page  + 5; $i++) :
            if ($i >= 1 and $i <= $pageTotal) : ?>
              <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
          <?php endif;
          endfor; ?>

          <li class="page-item">
            <a class="page-link"  href="?page=<?= $page+1 ?>">
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </li>
          <li class="page-item" >
            <a class="page-link"  href="?page=<?= $pageTotal ?>">
              <i class="fa-solid fa-angles-right"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
<div class="row">
    <div class="col">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><i class="fa-solid fa-trash"></i></th>
            <th>#</th>
            <th>姓名</th>
            <th>電郵</th>
            <th>手機</th>
            <th>生日</th>
            <th>地址</th>
            <th><i class="fa-solid fa-file-pen"></i></th>
          </tr>
        </thead> 
        <tbody>
          <?php foreach ($resultData as $r) : ?>
            <tr>
              <td>
                <a href="javascript: delete_one(<?= $r['sid'] ?>)">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
              <td><?= $r['sid'] ?></td>
              <td><?= $r['name'] ?></td>
              <td><?= $r['email'] ?></td>
              <td><?= $r['mobile'] ?></td>
              <td><?= $r['birthday'] ?></td>

              <td><?= htmlentities($r['address']) ?></td>
              <!--
              <td><?= strip_tags($r['address']) ?></td>
              -->
              <td><a href="edit.php?sid=<?= $r['sid'] ?>">
                  <i class="fa-solid fa-file-pen"></i>
                </a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    </div>
  </div>

</div>
<?php include __DIR__ . '/parts/scripts.php'  ?>
<script>
  function delete_one(sid) {
    if (confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
      location.href = `delete.php?sid=${sid}`;
    }
  }
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>