<template>
	<div>
		<section class="section-conten padding-y" style="min-height:84vh" v-if="otpVerification">
			<verify :phone="login.phone" :password="login.password" :loggedin="false"/>
		</section>
		<!-- ========================= SECTION CONTENT ========================= -->
		<section class="section-conten padding-y" style="min-height:84vh" v-else>
			<!-- ============================ COMPONENT LOGIN   ================================= -->
			<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
				<div class="card-body">
					<h4 class="card-title mb-4">Sign in</h4>
					<form @submit.prevent="userLogin">
						<!-- <a href="#" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp; Sign in with Facebook</a>
						<a href="#" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp; Sign in with Google</a> -->
						<div class="alert alert-danger d-flex justify-content-between align-items-center" v-if="login.errors.has('account')">
							<div>{{ login.errors.errors.account[0] }}</div> <i class="fas fa-info-circle"></i>
						</div>
						<div class="form-group">
							<input name="phone" v-model="login.phone" class="form-control" placeholder="phone" type="text" :class="{ 'is-invalid': login.errors.has('phone') }">
							<has-error :form="login" field="phone"></has-error>
						</div>
						<div class="form-group">
							<input name="password" v-model="login.password" class="form-control" placeholder="Password" type="password" :class="{ 'is-invalid': login.errors.has('password') }">
							<has-error :form="login" field="password"></has-error>
						</div>

						<div class="form-group">
							<nuxt-link :to="{name: 'auth-forgot'}" class="float-right">Forgot password?</nuxt-link>
							<label class="float-left custom-control custom-checkbox"> 
								<input type="checkbox" class="custom-control-input" v-model="login.remember">
								<div class="custom-control-label"> Remember </div>
							</label>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block"> Login </button>
						</div>
					</form>
				</div>
			</div>

			<p class="text-center mt-4">Don't have account? <nuxt-link :to="{name: 'register'}">Sign up</nuxt-link></p>
			<br><br>
			<!-- ============================ COMPONENT LOGIN  END.// ================================= -->
		</section>
		<!-- ========================= SECTION CONTENT END// ========================= -->
	</div>
</template>

<script>
import VerifyForm from '@/components/verify'

export default {
	middleware: 'guest',
	data() {
		return {
			otpVerification: false,
      		login: this.$vform({
				phone: '',
				password: '',
				remember: false,
			}),
		}
	},
	components: {
		'verify': VerifyForm,
	},
	methods: {
		async userLogin() {
			try {
				await this.login.post(process.env.BASE_URL+'/auth/login').then(response => {
					if(response.data.verificationFailed){
						this.otpVerification = true;
						return;
					}
				});
				
				let response = await this.$auth.loginWith('local', { data: this.login });

				this.loadWallet();
			} catch (err) {
				console.log(err)
			}
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
	.btn-facebook{background-color: #405D9D !important; color:#fff !important; &:hover{color:#fff !important} }
	.btn-instagram{background-color:#E52D27  !important; color:#fff !important; &:hover{color:#fff !important}}
	.btn-youtube{background-color: #C8046C !important; color:#fff !important; &:hover{color:#fff !important}}
	.btn-twitter{background-color:#42AEEC !important; color:#fff !important; &:hover{color:#fff !important}}
	.btn-google{  background-color:#ff7575 !important; color:#fff !important; &:hover{color:#fff !important} }
</style>