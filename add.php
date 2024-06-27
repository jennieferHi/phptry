<?php
require __DIR__ . '/parts/db_connect.php';

$pageName = 'add';
$title = '新增';

// 初始化
?>

<?php include __DIR__ . '/parts/html-head.php';?>
<?php include __DIR__ . '/parts/navbar.php';?>
<div class="add">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">新增資料</h5>
            <?php include __DIR__ . '/parts/form.php';?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/modal.php';?>
<?php include __DIR__ . '/data/vaildation.php';?>
<script>
        document.form1.addEventListener("submit", function(event) {
            event.preventDefault();


            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let mobile = document.getElementById("mobile").value;
            let birthday = document.getElementById("birthday").value;


            let validator = new Validation(name, email, mobile, birthday);


            if (validator.validateAll()) {
              const fd = new FormData(document.form1);

            fetch('add-api.php', {
                method: 'POST',
                body: fd, // content-type: multipart/form-data
              }).then(r => r.json())
              .then(result => {
                console.log(result); // 確認從伺服器返回的結果
                if(result.success){
                  myModal.show();
                }
              })
              .catch(ex => console.log(ex))
               }
                else
                {

                            displayErrors(validator.getErrors());
                    }
           });


        function displayErrors(errors) {
            document.getElementById("nameError").textContent = errors.name || '';
            document.getElementById("emailError").textContent = errors.email || '';
            document.getElementById("mobileError").textContent = errors.mobile || '';
            document.getElementById("birthdayError").textContent = errors.birthday || '';
        }
    </script>
<?php include __DIR__ . '/parts/scripts.php';?>
