<template>
    <div>
        <article class="card">
            <header class="card-header d-flex justify-content-between align-items-center">
                <h5 class=""> Withdraw </h5>
                <div> <nuxt-link :to="{ name: 'customer-affiliate' }" class="btn btn-primary">Affiliate Dashboard</nuxt-link> </div>
            </header>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore possimus obcaecati totam cumque soluta libero ratione id distinctio? Nobis ipsa quo neque quam assumenda blanditiis perferendis ex aspernatur laboriosam in!</p>
                <div class="bg-success text-white d-inline-block mb-3 px-3 py-2 rounded">Your Balance is - {{ wallet.balance }}</div>
                <div><a href="#" class="btn btn-primary" :class="{ 'disabled' : checkWithdrawAbility()}" :disabled="checkWithdrawAbility()" @click="withdraw">Withdraw Payment</a></div>
            </div>
        </article>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    scrollToTop: true,
    data(){
        return {
            name: 'Affiliate Dashboard',
            user: {},
            referrals: 0,
            affiliate: {},
        }
    },
    methods: {
        async withdraw(){
            await this.$axios.post(process.env.BASE_URL+'/withdraw');
        },

        async loadAffiliate(){
            await this.$axios.get(process.env.BASE_URL+'/affiliate').then(response => {
                this.affiliate = response.data;
            });
        },

        checkWithdrawAbility(){
            let amount = this.wallet.balance / this.affiliate.rupee_to_points;

            if(this.amount > this.affiliate.min_withdraw){
                return false;
            }else {
                return true;
            }
        }
	},

	created(){
        
    },
    computed: {
		...mapGetters(['isAuthenticated', 'loggedInUser']),
        wallet(){
            return this.$store.getters.getWallet;
        }
    },

    mounted(){
        this.loadAffiliate();
    }
}
</script>

<style>

</style>