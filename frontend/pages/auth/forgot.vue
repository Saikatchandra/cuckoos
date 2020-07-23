<template>
	<div>
		<!-- ========================= SECTION CONTENT ========================= -->
		<section class="section-conten padding-y" style="min-height:84vh">
			<!-- ============================ COMPONENT LOGIN   ================================= -->
			<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
				<div class="card-body" v-if="showPasswordResetForm">
                    <h4 class="card-title mb-4">Reset Password.</h4>
					<form @submit.prevent="resetPassword">
                        <div class="alert alert-danger" v-if="codeError">{{ errorMessage }}</div>
                        <div v-else>
                            <div class="alert alert-success" v-if="successMessage">Your password updated successfully.</div>
                            <div class="alert alert-danger" v-else>Enter the OTP code to reset your password.</div>
                        </div>
						<div class="form-group">
							<input name="otp" class="form-control" v-model="resetPasswordForm.otp" placeholder="Enter otp" type="text" :class="{ 'is-invalid': resetPasswordForm.errors.has('otp') }">
							<has-error :form="resetPasswordForm" field="otp"></has-error>
						</div>
						<div class="form-group">
							<input name="password" class="form-control" v-model="resetPasswordForm.password" placeholder="Enter password" type="password" :class="{ 'is-invalid': resetPasswordForm.errors.has('password') }">
							<has-error :form="resetPasswordForm" field="password"></has-error>
						</div>
						<div class="form-group">
							<input name="password_confirmation" class="form-control" v-model="resetPasswordForm.password_confirmation" placeholder="Confirm password" type="password" :class="{ 'is-invalid': resetPasswordForm.errors.has('password_confirmation') }">
							<has-error :form="resetPasswordForm" field="password_confirmation"></has-error>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block"> Update Password </button>
						</div>
					</form>
				</div>
				<div class="card-body" v-else>
					<h4 class="card-title mb-4">Forgot Password?</h4>
					<form @submit.prevent="forgotPassword">
						<!-- <div class="alert alert-danger d-flex justify-content-between align-items-center" v-if="login.errors.has('account')">
							<div>{{ login.errors.errors.account[0] }}</div> <i class="fas fa-info-circle"></i>
						</div> -->
						<div class="form-group">
							<input name="phone" v-model="forgotPasswordForm.phone" class="form-control" placeholder="Enter phone" type="text" :class="{ 'is-invalid': forgotPasswordForm.errors.has('phone') }">
							<has-error :form="forgotPasswordForm" field="phone"></has-error>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block"> Get OTP </button>
						</div>
					</form>
				</div>
			</div>

			<p class="text-center mt-4">Have an account? <nuxt-link :to="{name: 'login'}">Login</nuxt-link></p>
			<br><br>
			<!-- ============================ COMPONENT LOGIN  END.// ================================= -->
		</section>
		<!-- ========================= SECTION CONTENT END// ========================= -->
	</div>
</template>

<script>
export default {
	middleware: 'guest',
	data() {
		return {
            codeError: false,
			errorMessage: '',
			otpCodeSent: false,
            successMessage: false,
			forgotPasswordForm: this.$vform({
				phone: '',
			}),
			resetPasswordForm: this.$vform({
				phone: '',
                otp: '',
                password: '',
                password_confirmation: '',
			}),
            showPasswordResetForm: false,
		}
	},
	components: {
        
	},
	methods: {
        forgotPassword(){
            this.forgotPasswordForm.post(process.env.BASE_URL+'/forgot/password/').then(response => {
                if(response.data.success){
                    this.showPasswordResetForm = true;
                    this.$toast.success('OTP code has been sent to your Phone!', {duration: 8000,});
                }
            });
        },
        resetPassword(){
            this.resetPasswordForm.phone = this.forgotPasswordForm.phone;

            this.resetPasswordForm.post(process.env.BASE_URL+'/reset/password/').then(response => {
                let data = response.data;
				console.log(data);
                if(!data.expired && data.verified){
                    // if account is verified
                    this.codeError = false;
                    this.successMessage = true;
                    this.$toast.success('Your account has been verified');

                    if(this.loggedin){
                        this.$router.push({name: 'index'});
                    }else {
                        let response = this.$auth.loginWith('local', { data: {phone: this.resetPasswordForm.phone, password: this.resetPasswordForm.password} });
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
            });
        }, 
		
		async loadWallet(){
			await this.$axios.get(process.env.BASE_URL+'/wallet').then(response => {
				this.$store.commit('SET_WALLET', response.data);
			});
		},
	}
}
</script>

<style scoped lang="scss">

</style>