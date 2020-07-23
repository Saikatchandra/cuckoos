<template>
    <header class="section-header">
		<nav class="navbar navbar-dark navbar-expand p-0 bg-primary">
			<div class="container">
				<ul class="navbar-nav d-none d-md-flex mr-auto">
					<li class="nav-item"><nuxt-link class="nav-link" :to="{name: 'index'}">Home</nuxt-link></li>
					<li v-if="campaign && campaign.name" class="nav-item"><nuxt-link class="nav-link" :to="{name: 'campaign-slug'}">{{ campaign.name }}</nuxt-link></li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item"><a href="#" class="nav-link"> Call: {{ setting.phone }} </a></li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> English </a>
						<ul class="dropdown-menu dropdown-menu-right" style="max-w<h1> Campaign </h1>idth: 100px;">
							<li><a class="dropdown-item" href="#">Arabic</a></li>
							<li><a class="dropdown-item" href="#">Russian </a></li>
						</ul>
					</li>
				</ul>
            </div>
		</nav>
		<section class="header-main border-bottom">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-2 col-6">
						<nuxt-link :to="{ name: 'index' }" class="brand-wrap">
							<img class="logo img-fluid" v-if="setting.site_logo" :src="updateImageURL(setting.site_logo)">
							<img class="logo img-fluid" v-else src="~/static/images/logo.png">
						</nuxt-link>
					</div>
					<div class="col-lg-6 col-12 col-sm-12">
						<form @submit.prevent="searchProducts()" class="search">
							<div class="input-group w-100">
								<input type="text" v-model="search" class="form-control" placeholder="Search">
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="widgets-wrap float-md-right">
							<div class="widget-header  mr-3">
								<nuxt-link :to="{name: 'cart'}" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></nuxt-link>
								<span class="badge badge-pill badge-danger notify" v-if="cartItems">{{ cartItems.length }}</span>
								<span class="badge badge-pill badge-danger notify" v-else>0</span>
							</div>
							<div v-if="!isAuthenticated" class="widget-header icontext">
								<div class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></div>
								<div class="text">
									<span class="text-muted">Welcome!</span>
									<div>
										<nuxt-link :to="{name: 'login'}">Sign in</nuxt-link> |
										<nuxt-link :to="{name: 'register'}"> Register</nuxt-link>
									</div>
								</div>
							</div>
							<div v-else class="widget-header dropdown show">
								<a href="#" @click.prevent="accountDropdown = !accountDropdown">
									<div class="icontext">
										<div class="icon">
											<i class="icon-sm rounded-circle border fa fa-user"></i>
										</div>
										<div class="text">
											<small class="text-muted"> {{ loggedInUser.name }}</small>
											<div>My account <i class="fa fa-caret-down"></i> </div>
										</div>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-right" :class="{'show' : accountDropdown }" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 51px, 0px)">
									<nuxt-link class="dropdown-item" @click.native="hideDropdownMenu" :to="{name: 'customer-dashboard'}"> Dashboard </nuxt-link>
									<a class="dropdown-item" @click.prevent="logout" href="#">Logout</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- </header> -->
		<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
					aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="main_nav">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fa fa-bars"></i>
									&nbsp; All category</strong></a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Foods and Drink</a>
								<a class="dropdown-item" href="#">Home interior</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Category 1</a>
								<a class="dropdown-item" href="#">Category 2</a>
								<a class="dropdown-item" href="#">Category 3</a>
							</div>
						</li>
						<li class="nav-item" v-for="category in primaryMenu" :key="category.id">
							<nuxt-link class="nav-link" :to="{name: 'category-slug', params: {slug: category.slug}}">{{ category.name }}</nuxt-link>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
	data(){
		return {
			accountDropdown: false,
			primaryMenu: [],
			search: '',
		}
	},
	methods: {
		async logout(){
			this.$store.commit('SET_WALLET', {});

			await this.$auth.logout();
			this.accountDropdown = false;
		},

		loadWallet(){
			if(this.isAuthenticated && !Object.keys(this.wallet).length){
				this.$axios.get(process.env.BASE_URL+'/wallet').then(response => {
					this.$store.commit('SET_WALLET', response.data);
				});
			}
		},

		hideDropdownMenu(){
			this.accountDropdown = !this.accountDropdown;
		},
		loadCategories(){
			this.$axios.get(process.env.BASE_URL+'/primary-menu').then(response => {
				this.primaryMenu = response.data;

				this.$store.commit('SET_CATEGORIES', response.data);
			});
		},
		searchProducts(){
			if(this.$route.name == 'search'){
				if(this.query !== this.search){
					this.$store.commit('SET_QUERY', this.search);
					this.$router.push({ name: 'search', query: {query: this.search, page: 1 }});
				}
			}else {
				this.$store.commit('SET_QUERY', this.search);
				this.$router.push({ name: 'search', query: {query: this.search, page: 1 }});
			}
		},
        updateImageURL(image){
            if(image){
                return this.$store.getters.updateImageURL(image);
            }
        }
	},
	computed: {
		...mapGetters(['isAuthenticated', 'loggedInUser']),
        setting(){
            return this.$store.getters.getSetting;
        },
		wallet(){
            return this.$store.getters.getWallet;
		},
        campaign(){
            return this.$store.getters.getCampaign;
        },
		cartItems(){
			return this.$store.getters['cart/getCartProducts'];
		},
		query(){
			return this.$store.getters.getQuery;
		}
	},

	mounted(){
		this.loadCategories();
		let items = JSON.parse(localStorage.getItem('cartProducts'));
		this.$store.commit('cart/SET_CART_PRODUCTS', items);

		this.loadWallet();

		// get product box layout
		let layout = JSON.parse(localStorage.getItem('layout'));
		if(layout){
			this.$store.commit('SET_POST_LAYOUT', true);
		}else {
            localStorage.setItem('layout', JSON.stringify(false));
			this.$store.commit('SET_POST_LAYOUT', false);
		}
	},
	created(){
		// set search keyword.
		let query = this.$route.query.query;
		if(query){
			this.search = query;
			let pageNo = this.$route.query.page || 1;

			this.$store.commit('SET_QUERY', this.search);
			this.$router.push({name: 'search', query: {query: this.search, page: pageNo}});
		}
	}
}
</script>

<style>

</style>
