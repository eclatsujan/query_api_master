Vue.component('single-contact-form', {
    props: ['display_id'],
    data: function () {
        return {
            name: "",
            email: "",
            phone: "",
            subject: "",
            message: "",
            errors: [],
            alertMessage: "",
            alert: true,
            alertStatus: "",
            validator: helper.validator,
            errorMessage: helper.getErrorMessage,
            validationRules: {
                "name": ["empty"],
                "email": ["empty", "email"],
                "phone": ["empty"],
                "subject": ["empty"],
                "message": ["empty"]
            }
        }
    },
    mounted: function () {
        this.subject = "Inquiry For Property ID:" + this.display_id;
    },
    methods: {
        submitForm: function (e) {
            try {
                this.validateForm();
                let formData = new FormData();
                formData.append("action", "paig_send_email");
                formData.append("nonce", csAjax.nonce);
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('phone', this.phone);
                formData.append('subject', this.subject);
                formData.append('message', this.message);
                formData.append('url', window.location.href);
                axios({
                    method: 'post',
                    url: csAjax.ajaxURL,
                    data: formData
                }).then((response)=>response.data).then((response) => {
                    // console.log(!response["success"]);
                    if (!response["success"]) {
                        this.showAlert("error", response.data.msg);
                    }
                    else{
                        this.errors = [];
                        this.name = "";
                        this.email = "";
                        this.phone = "";
                        this.message = "";
                        this.showAlert("success", "Successfully send a form");
                    }

                }).catch((err) => {
                    this.showAlert("error", "Failed to send a form");
                });
            } catch (error) {
                this.showAlert("error", "Error on submitting a form.");
            }
        },
        validateForm: function () {
            let errors = {},
                error = false;
            Object.keys(this.validationRules).forEach((key) => {
                this.validationRules[key].forEach((rule) => {
                    if (!validator.validate(rule, key, this[key])) {
                        errors[key] = {};
                        error = true;
                        errors[key][rule] = this.errorMessage(rule);
                    }
                });
            });
            if (error) {
                this.errors = errors;
                throw "Validation Error";
            }
        },
        hasError: function (key) {
            return this.errors.hasOwnProperty(key);
        },
        showAlert(alertStatus, alertMessage) {
            this.alertMessage = alertMessage;
            this.alertStatus = alertStatus;
            this.alert = true;
            // this.$nextTick(()=>{
            //     setTimeout(()=>{
            //         this.alert=false;
            //     },2000);
            // });
        },
        getAlertClass() {
            return this.alertStatus === "success" ? "bg-theme-color" : "bg-red-800";
        }
    }
});