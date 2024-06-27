
<script>
class Validation {
    constructor(name, email, mobile, birthday) {
        this.name = name;
        this.email = email;
        this.mobile = mobile;
        this.birthday = birthday;
        this.errors = {};
    }


    validateName() {
        if (!this.name) {
            this.errors.name = '姓名不能為空';
        }
    }


    validateEmail() {
        if (!this.email) {
            this.errors.email = 'email不能為空';
        } else if (!/\S+@\S+\.\S+/.test(this.email)) {
            this.errors.email = 'email格式錯誤';
        }
    }


    validateMobile() {
        if (!this.mobile) {
            this.errors.mobile = '手機不能為空';
        } else if (!/^\d{10}$/.test(this.mobile)) {
            this.errors.mobile = '手機格式錯誤';
        }
    }


    validateBirthday() {
        if (!this.birthday) {
            this.errors.birthday = '生日不能為空';
        }
    }

    // 全部
    validateAll() {
        console.log(this.name);
        console.log(this.email);
        console.log(this.mobile);
        console.log(this.birthday);
        this.validateName();
        this.validateEmail();
        this.validateMobile();
        this.validateBirthday();
        return Object.keys(this.errors).length === 0;
    }
    

    getErrors() {
        return this.errors;
    }

}

</script>
