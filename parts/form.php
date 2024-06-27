
<?php
$name=$email=$mobile=$birthday=$address="";
?>
<form name="form1" method="post">
    <button onclick="setValue(event)">帶入</button>
    <div class="mb-1">
        <label for="name" class="form-label">姓名</label> 
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <div class="form-text " id="nameError"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></div>
    </div>
    <div class="mb-1">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="form-text " id="emailError"></div>
    </div>
    <div class="mb-1">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
        <div class="form-text " id="mobileError"></div>
    </div>
    <div class="mb-1">
        <label for="birthday" class="form-label">Birthday</label>
        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo htmlspecialchars($birthday); ?>">
        <div class="form-text " id="birthdayError"><?php echo isset($errors['birthday']) ? $errors['birthday'] : ''; ?></div>
    </div>
    <div class="mb-1">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" cols="30" rows="3"><?php echo htmlspecialchars($address); ?></textarea>
        <div class="form-text"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?></div>
    </div>
    <button type="submit" class="btn btn-primary">新增</button>
</form>
<script>
function setValue(event){
    event.preventDefault(); 
    document.getElementById("name").value="aaaa"
    document.getElementById("email").value="adfafae@gmail.com"
    document.getElementById("mobile").value="0900123123" 
    document.getElementById("birthday").value="1998-02-12" 
}
</script>