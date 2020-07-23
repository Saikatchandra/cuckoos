<template>
	<div>
		<section class="section-conten padding-y" style="min-height:84vh" v-if="otpVerification">
			<verify :phone="register.phone" :password="register.password" :loggedin="false"/>
		</section>
		<!-- ========================= SECTION CONTENT ========================= -->
		<section class="section-content padding-y" v-else>
			<!-- ============================ COMPONENT REGISTER   ================================= -->
			<div class="card mx-auto" style="max-width:420px; margin-top:40px;">
				<article class="card-body">
					<header class="mb-4">
						<h4 class="card-title text-center">Sign up</h4>
					</header>
					<form @submit.prevent="userRegister">
						<div class="text-center mb-4">
							<p v-if="referrer" class="py-2 px-5 mb-3 d-inline bg-success text-white rounded border shadow-sm">Referred by {{ referrer.name }} </p>
						</div>
						<div class="form-group">
							<label>Your name</label>
							<input type="text" name="name" v-model="register.name" class="form-control" placeholder="Name" :class="{ 'is-invalid': register.errors.has('name') }">
							<has-error :form="register" field="name"></has-error>
						</div>
						<div class="form-group">
							<label>Your Phone Number <small class="text-success">(Tip - Enter Number without +91)</small> </label>
							<input type="text" name="phone" v-model="register.phone" class="form-control" placeholder="Phone" :class="{ 'is-invalid': register.errors.has('phone') }">
							<has-error :form="register" field="phone"></has-error>
						</div>
						<div class="form-group">
							<label>Your email (Optional)</label>
							<input type="email" name="email" v-model="register.email" class="form-control" placeholder="Email" :class="{ 'is-invalid': register.errors.has('email') }">
							<has-error :form="register" field="email"></has-error>
						</div>
						<div class="form-group">
							<label>Choose a Password</label>
							<input type="password" name="password" v-model="register.password" autocomplete="off" class="form-control" placeholder="Password" :class="{ 'is-invalid': register.errors.has('password') }">
							<has-error :form="register" field="password"></has-error>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block"> Register </button>
						</div>
						<div class="form-group"> 
							<label class="custom-control custom-checkbox"> 
								<input type="checkbox" v-model="register.condition" :class="{ 'is-invalid': register.errors.has('condition') }" name="condition" class="custom-control-input"> 
								<div class="custom-control-label"> I am agree with 
									<nuxt-link :to="{name: 'terms-and-condition'}">terms and contitions</nuxt-link>  
								</div> 
							</label>
							<has-error :form="register" field="condition"></has-error>
						</div>
					</form>
				</article>
			</div>
			<p class="text-center mt-4">Have an account? <nuxt-link :to="{name: 'login'}">Log In</nuxt-link></p>
			<br><br>
			<!-- ============================ COMPONENT REGISTER  END.// ================================= -->
		</section>
		<!-- ========================= SECTION CONTENT END// ========================= -->
	</div>
</template>

<script>
import VerifyForm from '@/components/verify'

export default {
	middleware: 'guest',
	data(){
		return {
			referrer: '',
			otpVerification: false,
			register: this.$vform({
				name: '',
				phone: '',
				email: '',
				password: '',
				referrer: '',
				condition: null,
			}),
		}
	},
	components: {
		'verify': VerifyForm,
	},
	async asyncData({$axios, query}){
		let username = query.ref;
		
		if(username){
			let { data } = await $axios.get(process.env.BASE_URL+'/get/referrer/'+username);

			return { referrer: data }
		}
	},
	methods: {
		async userRegister(){
			if(this.referrer){
				this.register.referrer = this.referrer.username;
			}

			try {
				await this.register.post(process.env.BASE_URL+'/auth/register').then(response => {
					this.otpVerification = true;

                    this.$toast.success('Registration Successful!', {duration: 3000,});
                    this.$toast.success('Enter the OTP code sent your Mobile!', {duration: 6000,});
				});

			}catch(e){
				console.log(e);
			}
		},
		
	},
	mounted(){
		
	}
}
</script>

<style lang="scss">
	.form-group {
		.custom-control {
			input.is-invalid + .custom-control-label a {
				color: red;
			}
		}
	}
</style>