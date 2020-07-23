<template>
    <div>
        <article class="card">
            <header class="card-header"> 
                <h5 class="mb-0">Referral List</h5>
            </header>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td> 
                                User Name 
                            </td>
                            <td> 
                                Referral Level
                            </td>
                            <td> 
                                User Phone
                            </td>
                            <td> 
                                User Email
                            </td>
                            <td> 
                                Date
                            </td>
                        </tr>
                    </thead>
                    <tbody v-if="referrals.data && referrals.data.length">
                        <tr v-for="referral in referrals.data" :key="referral.id">
                            <td> {{ referral.user.name }} </td>
                            <td> {{ referral.level }} </td>
                            <td> {{ referral.user.phone }} </td>
                            <td> {{ referral.user.email }} </td>
                            <td> {{ formatDate(referral.created_at) }} </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="5"> 
                                <h5 class="text-center py-4">
                                    No data found.
                                </h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </article>
    </div>
</template>

<script>
import dayjs from 'dayjs';

export default {
    scrollToTop: true,
    data(){
        return {
            referrals: [],
        }
    },
    
    methods: {
        loadReferralData(){
            this.$axios.get(process.env.BASE_URL+'/get/referral/list').then(response => {
                this.referrals = response.data;
            });
        },
        formatDate(date){
            return dayjs(date).format('D MMMM YYYY');
        }
    },

    computed: {

    },
    
    created(){

    },

    mounted(){
        this.loadReferralData();
    },
}
</script>

<style>

</style>