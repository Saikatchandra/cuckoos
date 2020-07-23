<template>
    <div>
        <section class=" section-intro padding-y-sm">
            <div class="container">
                <article class="banner-wrap">
                        <img :src="campaignImage(campaign.banner)" class="w-100 rounded">
                </article>
            </div>
        </section>
        <section class="section-components padding-y">
            <div class="container">
                <header class="section-heading text-center">
                    <h2 class="section-title">{{ campaign.name }} Offer</h2>
                    <p>Front-end UI kit to create a e-commerce websites with html templates and code snippets. This <a href="doc.html" title="Bootstrap ui kit  framework documentation">UI framework</a> made for web developers to build all type of ecommerce platform.  ALl components based on Bootstrap 4 framework.  For more components and customization check <a target="_blank" href="https://getbootstrap.com/docs/4.3/getting-started/introduction/">Bootstrap documentation</a> </p>
                </header>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" v-for="product in products.data" :key="product.id">
                        <product :product="product" />
                    </div>
                </div>
                <div class="row" v-if="products.data">
                    <div class="col-12">
                        <nav aria-label="Page navigation sample">
                            <ul class="pagination">
                                <li class="page-item" :class="{ 'disabled' : !products.prev_page_url}"><a @click.prevent="loadCategories(products.prev_page_url)" class="page-link" href="#">Previous</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#">Page {{ products.current_page }} of {{ products.last_page }}</a></li>
                                <li class="page-item" :class="{ 'disabled' : !products.next_page_url}"><a @click.prevent="loadCategories(products.next_page_url)" class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Product from '../../components/Product'
export default {
    components: {
        'product': Product,
    },
    head(){

    },
    async asyncData({$axios}){
        let { data } = await $axios.get(process.env.BASE_URL+'/campaign');
            
        return {campaign: data[0], products: data[1] };
    },
    data(){
        return {
            campaign: {},
            products: [],
        }
    },
    methods: {
        campaignImage(image){
            return process.env.APP_URL + image;
        }
    },
    mounted(){
        
    },
    computed: {

    },
}
</script>

<style>

</style>