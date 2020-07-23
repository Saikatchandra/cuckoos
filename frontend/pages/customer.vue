<template>
    <div>
        <!-- ========================= SECTION CONTENT ========================= -->
	    <section class="section-conten padding-y" style="min-height:84vh" v-if="!loggedInUser.isVerified">
            <verify :phone="loggedInUser.phone" :loggedin="true"/>
        </section>
        <div v-else>
            <!-- ========================= SECTION PAGETOP ========================= -->
            <section class="section-pagetop bg">
                <div class="container">
                    <h2 class="title-page">{{ pageName }}</h2> 
                </div>
            </section>
            <!-- ========================= SECTION INTRO END// ========================= -->

            <!-- ========================= SECTION CONTENT ========================= -->
            <section class="section-content padding-y">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-3">
                            <ul class="list-group">
                                <nuxt-link class="list-group-item" :to="{name: 'customer-dashboard'}">Dashboard </nuxt-link>
                                <nuxt-link class="list-group-item" :to="{name: 'customer-affiliate'}">Affiliate </nuxt-link>
                                <nuxt-link class="list-group-item" :to="{name: 'customer-order'}"> Orders </nuxt-link>
                                <nuxt-link class="list-group-item" :to="{name: 'customer-tracking'}"> Order Tracking </nuxt-link>
                                <nuxt-link class="list-group-item" :to="{name: 'customer-transaction'}"> Transaction </nuxt-link>
                                <nuxt-link class="list-group-item" :to="{name: 'customer-refund'}"> Return and refunds </nuxt-link>
                                <!-- <nuxt-link class="list-group-item" :to="{name: 'customer-billing'}"> Billing  </nuxt-link> -->
                                <nuxt-link class="list-group-item" :to="{name: 'customer-shipping'}"> Shipping </nuxt-link>
                                <nuxt-link class="list-group-item" :to="{name: 'customer-setting'}">Settings </nuxt-link>
                            </ul>
                            <br>
                            <a class="btn btn-light btn-block" href="#" @click.prevent="logout"> <i class="fa fa-power-off"></i> <span class="text">Log out</span> </a>
                        </aside>
                        <main class="col-md-9">
                            <nuxt-child />
                        </main>
                    </div>
                </div>
            </section>
            <!-- ========================= SECTION CONTENT END// ========================= -->
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import VerifyForm from '@/components/verify'

export default {
    middleware: 'auth',
    data(){
        return {
        }
    },
    components: {
        'verify': VerifyForm,
    },
	methods: {
		async logout(){
			await this.$auth.logout();
		},
	},
	computed: {
        pageName() {
            return this.$store.getters.getPageName;
        },
		...mapGetters(['isAuthenticated', 'loggedInUser']),
	},

	mounted(){

    }
}
</script>

<style>

</style>