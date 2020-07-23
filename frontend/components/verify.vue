<template>
    <!-- ============================ COMPONENT LOGIN   ================================= -->
    <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
        <article class="card-body">
            <header class="mb-4">
                <h4 class="card-title">OTP Verification</h4>
            </header>
            <form @submit.prevent="verifyOTP">
                <div class="alert alert-danger" v-if="codeError">{{ errorMessage }}</div>
                <div v-else>
                    <div class="alert alert-success" v-if="successMessage">Your account is verified.</div>
                    <div class="alert alert-danger" v-else>Your account is not verified. Verify first.</div>
                </div>
                <div class="form-group">
                    <label>Enter OTP Code</label>
                    <input type="number" name="code" v-model="otpCode.code" class="form-control" placeholder="OTP Code" :class="{ 'is-invalid': otpCode.errors.has('code') || codeError }">
                    <has-error :form="otpCode" field="code"></has-error>
                    <div>
                        <div v-if="otpCodeSent" class="badge text-success"> Code has been sent to your phone. </div>
                        <div v-else @click="resendCode" class="badge text-primary" style="cursor:pointer"> Resend Code?  </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Verify your account. </button>
                </div>
            </form>
        </article>
    </div>
</template>

<script>
export default {
    props: ['phone', 'password', 'loggedin'],
    data(){
        return {
            verifyPhone: false,
			codeError: false,
			errorMessage: '',
			otpCodeSent: false,
            successMessage: false,
			otpCode: this.$vform({
				code: '',
				phone: '',
			}),
        }
    },
    methods: {
        async verifyOTP(){
            this.otpCode.phone = this.phone;
            try {
                await this.otpCode.post(process.env.BASE_URL+'/verify/otp').then(response => {
                    let data = response.data;

                    if(!data.expired && data.verified){
                        // if account is verified
                        this.codeError = false;
                        this.successMessage = true;
                        this.$toast.success('Your account has been verified');

                        if(this.loggedin){
                            this.$router.push({name: 'index'});
                        }else {
                            let response = this.$auth.loginWith('local', { data: {phone: this.phone, password: this.password} });
                            
				            this.loadWallet();
                        }
                    }else if(data.expired && data.verified){
                        // if OTP code is wrong
                        this.codeError = true;
                        this.errorMessage = data.message;
                    }else {
                        // OTP code has expired
                        this.codeError = true;
                        this.errorMessage = data.message;
                    }
                    // await this.$auth.loginWith('local', { data: this.register })
                });

            }catch(e){
                console.log(e);
            }
        },

		async loadWallet(){
			await this.$axios.get(process.env.BASE_URL+'/wallet').then(response => {
				this.$store.commit('SET_WALLET', response.data);
			});
		},

        async resendCode(){
            try {
                await this.$axios.post(process.env.BASE_URL+'/resend/otp', { phone: this.phone}).then(response => {
                    console.log(response);
                    this.otpCodeSent = true;

                    this.hideOtpSentMessage();
                })
            } catch(e){

            }
        },
        hideOtpSentMessage(){
            setTimeout(() => {
                this.otpCodeSent = false
            }, 10000);
        }
    }
}
</script>

<style>

</style>