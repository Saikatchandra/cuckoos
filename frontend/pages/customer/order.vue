<template>
    <div>
        <div class="order-list">
            <div v-if="orders.length">
                <article class="card mb-4" v-for="order in orders" :key="order.id">
                    <header class="card-header">
                        <strong class="d-inline-block mr-3">Order ID: {{ order.id }}</strong>
                        <span>Order Date: {{ formatDate(order.created_at) }}</span>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="text-muted">Delivery to</h6>
                                <p>{{ order.customer_name }} <br>
                                    Phone {{ order.customer_phone }} Email: myname@pixsellz.com <br>
                                    Location: {{ order.customer_address }} <br>
                                    P.O. Box: {{ order.postal_code }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">Payment</h6>
                                    <span class="text-success">
                                        <i class="fab fa-lg fa-cc-visa"></i>
                                        Visa **** 4216
                                    </span>
                                    <p>Subtotal: ${{ productPrice(order.total_price - order.shipping_cost) }} <br>
                                    Shipping fee: ${{ productPrice(order.shipping_cost) }} <br>
                                    <span class="b">Total: ${{ productPrice(order.total_price) }} </span>
                                </p>
                            </div>
                        </div> <!-- row.// -->
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr v-for="product in order.products" :key="product.id">
                                    <td width="65">
                                        <img :src="product.image" class="img-xs border">
                                    </td>
                                    <td>
                                        <p class="title mb-0"> {{ product.title }} </p>
                                        <var class="price text-muted">${{ productPrice(product.price) }}</var>
                                    </td>
                                    <td> Seller <br> Nike clothing </td>
                                    <td width="250"> <a href="#" class="btn btn-outline-primary">Track order</a> <a href="#"
                                        class="btn btn-light"> Details </a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </article>    
            </div>
            <div v-else>
                <div class="card mb-4">
                    <div class="card-header"> Order List </div>
                    <div class="card-body">
                        <h5 class="py-5 text-center">No order found.</h5>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="orders.length > 9">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{ 'disabled' : !prev_page_url}"><a class="page-link" @click.prevent="getOrders(prev_page_url)" href="#">Previous</a></li>
                    <li class="page-item" :class="{ 'disabled' : !next_page_url}"><a class="page-link" @click.prevent="getOrders(next_page_url)" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs';

export default {
    scrollToTop: true,
    data() {
        return {
            name: 'My Orders',
            orders: [],
            next_page_url: null,
            prev_page_url: null,
        }
    },
    async asyncData({$axios}){
        let { data } = await $axios.get(process.env.BASE_URL+'/orders');

        return {orders: data.data, next_page_url: data.next_page_url, prev_page_url: data.prev_page_url}
    },
    methods: {
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        },

        productPrice(value){
			return (value/100).toFixed(2);
        },
        formatDate(date){
            return dayjs(date).format('D MMMM YYYY');
        }
	},

	created(){
        this.setPageName();
    },

	computed: {
        
	},

}
</script>

<style>

</style>