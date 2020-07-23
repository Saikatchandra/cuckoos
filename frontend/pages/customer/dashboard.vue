<template>
    <div>
        <article class="card mb-3">
            <div class="card-body">
                <figure class="icontext">
                    <div class="icon">
                        <img v-if="loggedInUser.avatar" class="rounded-circle img-sm border" :src="updateImageURL(loggedInUser.avatar)">
                        <img v-else class="rounded-circle img-sm border" src="~/static/images/avatars/avatar3.jpg">
                    </div>
                    <div class="text">
                        <strong> {{ loggedInUser.name }} </strong> <br>
                            {{ loggedInUser.email || loggedInUser.phone }} <br>
                        <nuxt-link :to="{name: 'customer-setting'}">Edit</nuxt-link>
                    </div>
                </figure>
                <hr>
                <article class="card-group">
                    <figure class="card bg">
                        <div class="p-3">
                            <h5 class="card-title">38</h5>
                            <span>Orders</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                            <h5 class="card-title">5</h5>
                            <span>Wishlists</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                            <h5 class="card-title">12</h5>
                            <span>Awaiting delivery</span>
                        </div>
                    </figure>
                    <figure class="card bg">
                        <div class="p-3">
                            <h5 class="card-title">50</h5>
                            <span>Delivered items</span>
                        </div>
                    </figure>
                </article>
            </div>
        </article>

        <article class="card  mb-3">
            <div class="card-body" v-if="order && order.products">
                <h5 class="card-title mb-4">Recent orders </h5>
                <div class="row">
                    <div class="col-md-6" v-for="product in order.products" :key="product.id">
                        <figure class="itemside  mb-3">
                            <div class="aside"><img :src="product.image" class="border img-sm"></div>
                            <figcaption class="info">
                                <time class="text-muted">
                                    <i class="fa fa-calendar-alt"></i>
                                    {{ updateDate(product.created_at) }}
                                </time>
                                <p> {{ product.title }} </p>
                                <span v-if="order.status == 0" class="badge badge-warning"> Pending </span>
                                <span v-else-if="order.status == 1" class="badge badge-danger"> Rejected </span>
                                <span v-else-if="order.status == 2" class="badge badge-primary"> Shipped </span>
                                <span v-else class="badge badge-success"> Completed </span>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <nuxt-link :to="{name: 'customer-order'}" class="btn btn-outline-primary"> See all orders </nuxt-link>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="py-5 text-center">Order history not found.</h5>
                    </div>
                </div>
            </div>
        </article>
    </div>
</template>

<script>
import dayjs from 'dayjs';
import { mapGetters } from 'vuex'
export default {
    scrollToTop: true,
    data(){
        return {
            name: 'My Account',
            order: {},
        }
    },
	methods: {
        loadRecentOrder(){
            this.$axios.get(process.env.BASE_URL+'/recent/orders').then(response => {
                this.order = response.data;
            });

        },
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        },
        updateImageURL(image){
            if(image){
                return this.$store.getters.updateImageURL(image);
            }
        },
        updateDate(date){
            return dayjs(date).format('DD.MM.YYYY');
        }
	},
	computed: {
		...mapGetters(['isAuthenticated', 'loggedInUser']),
	},

	created(){
        this.setPageName();
    },

    mounted(){
        this.loadRecentOrder();
    }
}
</script>

<style>

</style>