<template>
    <div>
        <!-- ========================= SECTION PAGETOP ========================= -->
        <section class="section-pagetop bg">
            <div class="container">
                <h2 class="title-page"> {{ products.total }} products found on this keyword "{{ query }}" </h2>
                <nav>
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item"><nuxt-link :to="{name: 'index'}"> Home </nuxt-link></li>
                        <li class="breadcrumb-item active"> search page </li>
                    </ol>
                </nav>
            </div> <!-- container //  -->
        </section>
        <!-- ========================= SECTION INTRO END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content padding-y">
            <div class="container">
                <div class="row" v-if="products.data && products.data.length">
                    <div class="col-md-3" v-for="product in products.data" :key="product.id">
                        <Product :product="product" />
                    </div>
                </div>
                <div class="row" v-else>
                    <div class="col">
                        <h5 class="text-center py-5">No products found</h5>
                    </div>
                </div>
                <nav aria-label="Page navigation sample">
                    <ul class="pagination">
                        <li class="page-item" :class="{ 'disabled' : !products.prev_page_url}">
                            <a @click.prevent="loadCategories(products.prev_page_url, 'prev')" class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item disabled"><a class="page-link" href="#">Page {{ products.current_page }} of {{ products.last_page }}</a></li>
                        <li class="page-item" :class="{ 'disabled' : !products.next_page_url}">
                            <a @click.prevent="loadCategories(products.next_page_url, 'next')" class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
</template>

<script>
import Product from '@/components/Product';

export default {
    components: {
        Product,
    },
    data(){
        return {
            products: [],
        }
    },
    async asyncData({$axios, route, env}){
        let query = route.query.query;
        let pageNo = route.query.page || 1;

        let data = await $axios.get(env.BASE_URL+'/search?query='+ query + '&page=' + pageNo);

        return {products: data.data }
    },
    methods: {
        async loadProducts(){
            let query = this.query;
            let pageNo = this.$route.query.page || 1;
            let data = await this.$axios.get(process.env.BASE_URL+'/search?query='+ query + '&page=' + pageNo);
            
            this.products = data.data;
        },
        loadCategories(pageUrl, direction){
            let pageNo = direction == 'next' ? this.products.current_page+1 : this.products.current_page-1;
            this.$router.push({name: 'search', query: { query: this.query, page: pageNo }});

            this.$axios.get(pageUrl).then(response => {
                this.products = response.data;
            });

            // window.scrollTo(0, top);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        },
    },
    mounted(){
        this.loadProducts();
    },
    computed: {
        query(){
            return this.$store.getters.getQuery;
        }
    },
    watch: {
        query(newQuery) {
            setTimeout(() => {
                this.loadProducts();
            }, 500);
        },
        $route (to, from, next){
            // console.log(to);
            // console.log(from);
            // console.log(next);
            // this.$forceUpdate();
        }
    }
}
</script>

<style>

</style>
