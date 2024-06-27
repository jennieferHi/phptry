
<?php
require __DIR__ . "/parts/db_connect.php";
include __DIR__ . "/parts/html-head.php";
include __DIR__ . "/parts/navbar.php";

?>
<div class="login" >
      <div class="card">
      <span class="small"></span>
        <div class="card-body">
          <h5 class="card-title">會員登入</h5>
          <form name="form1" method="post" onsubmit="sendForm(event)">

            <div class="mb-3">
              <label for="email" class="form-label">email 帳號</label>
              <input type="text" class="form-control" id="email" name="email">
              <div class="form-text" id="nameError"></div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">密碼</label>
              <input type="password" class="form-control" id="password" name="password">
              <div class="form-text" id="passwordErr"></div>
            </div>

            <button type="submit" class="btn btn-primary">登入</button>
          </form>

  </div>

</div>

</div>
    <?php
include __DIR__ . '/data/validation_login.php';
include "./parts/scripts.php"
?>



<script>
  // 樣式
  let forbox = document.querySelector(".card");
  let smallbox = document.querySelector(".small");
    let in2 = document.querySelector(".in");
    forbox.addEventListener("mouseenter",(e)=>{
        mIn = e.clientX - e.target.offsetLeft;
        mout = e.clientY - e.target.offsetTop;
        console.log(mIn)

        smallbox.style.left=mIn+"px";
        smallbox.style.top=mout+"px";
        console.log(smallbox.style.left)
    })

    const sendForm = e => {
       e.preventDefault(); 
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value; 
      // "沒有外觀" 的表單
      const fd = new FormData(document.form1);

      let validator = new ValidationLogin(email, password); 
      if (validator.validateAll()) {
        fetch('login-api.php', {
        method: 'POST',
        body: fd, // content-type: multipart/form-data
  }).then(r => r.json())
  .then(result => {
    console.log({
      result
    });
    if(result.success){
      location.href = './index.php';
    } else {
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
            document.getElementById("nameError").textContent = errors.email || '';
            document.getElementById("passwordErr").textContent = errors.password || '';
       }

</script>
