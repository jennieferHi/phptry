
<script>
class ValidationLogin {
    constructor( email,password) {
        this.password = password;
        this.email = email;
        this.errors = {};
    }


    validatePassword() {
        if (!this.password) {
            this.errors.password = '密碼不能為空';
        }
    }


    validateEmail() {
        if (!this.email) {
            this.errors.email = 'email不能為空';
        } else if (!/\S+@\S+\.\S+/.test(this.email)) {
            this.errors.email = 'email格式錯誤';
        }
    }

    // 全部
    validateAll() {
     
        this.validatePassword();
        this.validateEmail();
     
        return Object.keys(this.errors).length === 0;
    }
    

    getErrors() {
        return this.errors;
    }

}

</script>
