<template>
    <div>
        <article class="card">
            <header class="card-header d-flex justify-content-between align-items-center">
                <h5 class="">Affiliate Dashboard</h5>
                <div>
                    <nuxt-link :to="{ name: 'customer-verify' }" class="btn btn-primary">Submit Your KYC</nuxt-link>
                    <nuxt-link :to="{ name: 'customer-withdraw' }" class="btn btn-warning">Withdraw</nuxt-link>
                </div>
            </header>
            <div class="card-body">
                <div class="row">

                    <div class="col-4 offset-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fas fa-money-check-alt white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ wallet.balance }}</h6>
                                        <p class="text-muted"> Your Wallet </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="">Your Referral Link</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="referralLInk" v-model="loggedInUser.referral_link" placeholder="Your referral link" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-primary" @click="copyTestingCode()" type="button">Copy</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Analytics</h4>
                            <nuxt-link :to="{name: 'customer-referral-list' }" class="btn btn-primary">Refferal List</nuxt-link>
                        </div>
                        <hr>
                    </div>
                    <!-- <div class="col-4">
                        <div class="card">
                            <div class="card-header"> <span class="info-box-text">Your Commision</span> </div>
                            <div class="card-body">
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header"> <span class="info-box-text">Total Clicks</span> </div>
                            <div class="card-body">
                                <span class="info-box-number">0</span>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level1 }}</h6>
                                        <p class="text-muted">Level 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level2 }}</h6>
                                        <p class="text-muted">Level 2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level3 }}</h6>
                                        <p class="text-muted">Level 3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level4 }}</h6>
                                        <p class="text-muted">Level 4</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level5 }}</h6>
                                        <p class="text-muted">Level 5</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level6 }}</h6>
                                        <p class="text-muted">Level 6</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level7 }}</h6>
                                        <p class="text-muted">Level 7</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level8 }}</h6>
                                        <p class="text-muted">Level 8</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level9 }}</h6>
                                        <p class="text-muted">Level 9</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="icontext align-items-start mr-4 align-items-center" style="max-width: 300px;">
                                    <span class="icon icon-md rounded-circle bg-primary mr-4">
                                        <i class="fa fa-users white"></i>
                                    </span>
                                    <div class="text">
                                        <h6 class="title mb-2">{{ userReferral.level10 }}</h6>
                                        <p class="text-muted">Level 10</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="mt-5">
                    <nuxt-link :to="{ name: 'customer-verify' }" class="btn btn-primary">Submit Your KYC</nuxt-link>
                    <nuxt-link :to="{ name: 'customer-verify' }" class="btn btn-info">Withdraw</nuxt-link>
                </div> -->
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
            userReferral: {
                level1: 0,
                level2: 0,
                level3: 0,
                level4: 0,
                level5: 0,
                level6: 0,
                level7: 0,
                level8: 0,
                level9: 0,
                level10: 0,
            },

        }
    },
    methods: {
        loadAffiliateData(){
            this.$axios.get(process.env.BASE_URL+'/affiliate/data').then(response => {
                this.userReferral.level1 = response.data[0]
                this.userReferral.level2 = response.data[1]
                this.userReferral.level3 = response.data[2]
                this.userReferral.level4 = response.data[3]
                this.userReferral.level5 = response.data[4]
                this.userReferral.level6 = response.data[5]
                this.userReferral.level7 = response.data[6]
                this.userReferral.level8 = response.data[7]
                this.userReferral.level9 = response.data[8]
                this.userReferral.level10 = response.data[9]
            });
        },
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        },
        copyTestingCode () {
            let testingCodeToCopy = document.querySelector('#referralLInk')
            testingCodeToCopy.select()

            try {
                var successful = document.execCommand('copy');
            } catch (err) {
                alert('Oops, unable to copy');
            }

            /* unselect the range */
            window.getSelection().removeAllRanges()
        },
        loadUser(){
            this.$axios.get(process.env.BASE_URL+'/user').then(response => {
                this.user = response.data[0];
                this.referrals = response.data[1];
            });
        }
	},

	created(){
        this.setPageName();
    },
    computed: {
		...mapGetters(['isAuthenticated', 'loggedInUser']),
        wallet(){
            return this.$store.getters.getWallet
        },
    },

    mounted(){
        this.loadUser();
        this.loadAffiliateData();
    }
}
</script>

<style>

</style>