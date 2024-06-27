<?php 
 
require __DIR__ . '/parts/db_connect.php';
$pageName = 'add';
$title = '新增';

?>
<?php include __DIR__ . '/parts/html-head.php'  ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
<style>
  form .mb-3 .form-text {
    color: red;
  }
</style>
<div class="add ">

      <div class="card">

        <div class="card-body">
          <h5 class="card-title">新增資料</h5>
          <form name="form1" method="post" onsubmit="sendForm(event)">
            <div class="mb-1">
              <label for="name" class="form-label">姓名</label>
              <input type="text" class="form-control" id="name" name="name">
              <div class="form-text"></div>
            </div>
            <div class="mb-1">
              <label for="email" class="form-label">email</label>
              <input type="text" class="form-control" id="email" name="email">
              <div class="form-text"></div>
            </div>
            <div class="mb-1">
              <label for="mobile" class="form-label">mobile</label>
              <input type="text" class="form-control" id="mobile" name="mobile">
              <div class="form-text"></div>
            </div>
            <div class="mb-1">
              <label for="birthday" class="form-label">birthday</label>
              <input type="date" class="form-control" id="birthday" name="birthday">
              <div class="form-text"></div>
            </div>
            <div class="mb-1">
              <label for="address" class="form-label">address</label>
              <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">新增</button>
          </form>

    </div>
  </div>

  <!-- Button trigger modal -->
  <!--
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
-->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">新增結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          新增成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
        <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'  ?>
<script>
  const sendForm=(e)=>{ 
    const {email:email_f,name:name_f,mobile:mobile_f,birthday:birthday_f}=document.form1;
  let isPass=true;  
  e.preventDefault(); 
  let secondItem="";
  if(email_f.value.length<2){
    email_f.classList.add('info'); 
    secondItem = email_f.nextElementSibling; 
    secondItem.innerHTML = "<div class='info'>innerHTML HELLO</div>";
    isPass=false;
  }else{
    email_f.classList.remove('info'); 
    secondItem = email_f.nextElementSibling; 
    secondItem.innerHTML = "";
  }

  if(name_f.value.length<2){
    name_f.classList.add('info');
    secondItem = name_f.nextElementSibling; 
    secondItem.innerHTML = "<div class='info'>innerHTML HELLO</div>";
  }else{
    name_f.classList.remove('info');
    secondItem = name_f.nextElementSibling; 
    secondItem.innerHTML = "";
  }

  if(mobile_f.value.length!=10){
    mobile_f.classList.add('info');
    secondItem = mobile_f.nextElementSibling; 
    secondItem.innerHTML = "<div class='info'>innerHTML HELLO</div>";
  } else{
    mobile_f.classList.remove('info');
    secondItem = mobile_f.nextElementSibling; 
    secondItem.innerHTML = "";
  }

  if(!birthday_f.value.length){
    birthday_f.classList.remove('info');
    secondItem = birthday_f.nextElementSibling;
    secondItem.innerHTML = "<div class='info'>innerHTML HELLO</div>"; 

  }else{
    birthday_f.classList.remove('info');
    secondItem = birthday_f.nextElementSibling;
    secondItem.innerHTML = "";
  }
  
    if (isPass) {
      // "沒有外觀" 的表單
      const fd = new FormData(document.form1);

      fetch('add-api.php', {
          method: 'POST',
          body: fd, // content-type: multipart/form-data
        }).then(r => r.json())
        .then(result => {
          console.log({
            result
          });
          if(result.success){
            myModal.show();
          }
        })
        .catch(ex => console.log(ex))
    }

 }


  const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>