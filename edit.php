<?php

require __DIR__ . '/parts/db_connect.php';
include __DIR__ . '/data/db/address_book.php';
include __DIR__ . '/data/vaildation.php';
$pageName = 'edit';
$title = '編輯';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$address_book = new Address_book();
$row = json_decode($address_book->editSelect($sid), true);
$row = $row["result"];

if (empty($row)) {
    header('Location: list.php');
    exit; # 結束 php 程式
}

?>
<?php include __DIR__ . '/parts/html-head.php'?>
<?php include __DIR__ . '/parts/navbar.php'?>
<style>
  form .mb-3 .form-text {
    color: red;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card">

        <div class="card-body">
          <h5 class="card-title">編輯資料</h5>
          <form name="form1" method="post" onsubmit="sendForm(event)">
            <div class="mb-3">
              <label class="form-label">編號</label>
              <input type="text" class="form-control" disabled value="<?=$row['sid']?>">
            </div>
            <input type="hidden" name="sid" value="<?=$row['sid']?>">
            <div class="mb-3">
              <label for="name" class="form-label">姓名</label>
              <input type="text" class="form-control" id="name" name="name" value="<?=htmlentities($row['name'])?>">
              <div class="form-text" id="nameError"></div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?=$row['email']?>">
              <div class="form-text" id="emailError"></div>
            </div>
            <div class="mb-3">
              <label for="mobile" class="form-label">mobile</label>
              <input type="text" class="form-control" id="mobile" name="mobile" value="<?=$row['mobile']?>">
              <div class="form-text" id="mobileError"></div>
            </div>
            <div class="mb-3">
              <label for="birthday" class="form-label">birthday</label>
              <input type="date" class="form-control" id="birthday" name="birthday" value="<?=$row['birthday']?>">
              <div class="form-text"  id="birthdayError"></div>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">address</label>
              <textarea class="form-control" name="address" id="address" cols="30" rows="3"><?=$row['address']?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">修改</button>
          </form>

        </div>
      </div>
    </div>
  </div>


</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          編輯成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續編輯</button>
        <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'?>
<script> 

  const sendForm = e => {
    e.preventDefault();
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let mobile = document.getElementById("mobile").value;
     let birthday = document.getElementById("birthday").value;
      // "沒有外觀" 的表單
      const fd = new FormData(document.form1);

      let validator = new Validation(name, email, mobile, birthday);
console.log(validator.getErrors())
      if (validator.validateAll()) {
      fetch('edit-api.php', {
          method: 'POST',
          body: fd, // content-type: multipart/form-data
        }).then(r => r.json())
        .then(result => {
          console.log({
            result
          });
          if (result.success) {
            myModal.show();
          }
        })
        .catch(ex => console.log(ex))
    } else
                {

                            displayErrors(validator.getErrors());
                    }
  }
  function displayErrors(errors) {
            document.getElementById("nameError").textContent = errors.name || '';
            document.getElementById("emailError").textContent = errors.email || '';
            document.getElementById("mobileError").textContent = errors.mobile || '';
            document.getElementById("birthdayError").textContent = errors.birthday || '';
        }
  const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
</script>
<?php include __DIR__ . '/parts/html-foot.php'?>