<template>
    <div>
        <!-- ========================= SECTION INTRO ========================= -->
        <section class="section-intro padding-y-sm">
            <div class="container">
              
                <div class="intro-banner-wrap">
                    
                    <img src="~/static/images/banners/1.jpg" class="img-fluid rounded">
                    <!-- <img :src="this.slider.slider_image" class="img-fluid rounded"> -->
                </div>
            </div>
        </section>
        <!-- ========================= SECTION INTRO END// ========================= -->

        <!-- ========================= SECTION FEATURE ========================= -->
        <section class="section-content padding-y-sm">
            <div class="container">
                <article class="card card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <figure class="item-feature">
                                <span class="text-primary"><i class="fa fa-2x fa-truck"></i></span>
                                <figcaption class="pt-3">
                                    <h5 class="title">Fast delivery nn</h5>
                                    <p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore </p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-4">
                            <figure class="item-feature">
                                <span class="text-primary"><i class="fa fa-2x fa-landmark"></i></span>
                                <figcaption class="pt-3">
                                    <h5 class="title">Creative Strategy</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-4">
                            <figure class="item-feature">
                                <span class="text-primary"><i class="fa fa-2x fa-lock"></i></span>
                                <figcaption class="pt-3">
                                    <h5 class="title">High secured </h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <!-- ========================= SECTION FEATURE END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content">
            <div class="container">
                <header class="section-heading">
                    <h3 class="section-title">Popular products</h3>
                </header>
                <div class="row">
                    <div class="col-md-3" v-for="product in popularProducts" :key="product.id">
                        <Product :product="product" />
                    </div>
                </div>
            </div>
        </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content">
            <div class="container">
                <header class="section-heading">
                    <h3 class="section-title">New arrived</h3>
                </header>
                <div class="row">
                    <div class="col-md-3" v-for="product in newProducts" :key="product.id">
                        <Product :product="product" />
                    </div>
                </div>
            </div>
        </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content padding-bottom-sm">
            <div class="container">
                <header class="section-heading">
                    <a href="#" class="btn btn-outline-primary float-right">See all</a>
                    <h3 class="section-title">Recommended</h3>
                </header>
                <div class="row">
                    <div class="col-md-3" v-for="product in recommendProducts" :key="product.id">
                        <Product :product="product" />
                    </div>
                </div>
            </div>
        </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->

        <!-- ========================= SECTION  ========================= -->
        <section class="section-name bg padding-y-sm">
            <div class="container">
                <header class="section-heading">
                    <h3 class="section-title">Our Brands</h3>
                </header>
                <div class="row">
                    <div class="col-md-2 col-6">
                        <figure class="box item-logo">
                            <a href="#"><img src="~/static/images/logos/logo1.png"></a>
                            <figcaption class="border-top pt-2">36 Products</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-2  col-6">
                        <figure class="box item-logo">
                            <a href="#"><img src="~/static/images/logos/logo2.png"></a>
                            <figcaption class="border-top pt-2">980 Products</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-2  col-6">
                        <figure class="box item-logo">
                            <a href="#"><img src="~/static/images/logos/logo3.png"></a>
                            <figcaption class="border-top pt-2">25 Products</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-2  col-6">
                        <figure class="box item-logo">
                            <a href="#"><img src="~/static/images/logos/logo4.png"></a>
                            <figcaption class="border-top pt-2">72 Products</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-2  col-6">
                        <figure class="box item-logo">
                            <a href="#"><img src="~/static/images/logos/logo5.png"></a>
                            <figcaption class="border-top pt-2">41 Products</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-2  col-6">
                        <figure class="box item-logo">
                            <a href="#"><img src="~/static/images/logos/logo2.png"></a>
                            <figcaption class="border-top pt-2">12 Products</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>
        <!-- ========================= SECTION  END// ========================= -->
    </div>
</template>

<script>
import Product from '../components/Product'

export default {
    components: {
        Product,
    },
    data(){
        return {
            popularProducts: [],
            newProducts: [],
            recommendProducts: [],
            slider: [],
        }
    },
    methods: {
        async loadPopularProducts(){
            await this.$axios.get(process.env.BASE_URL+'/products/popular').then(response => {
                this.popularProducts = response.data;
            });
        },
        async loadNewProducts(){
            await this.$axios.get(process.env.BASE_URL+'/products/new').then(response => {
                this.newProducts = response.data;
            });
        },
        async loadRecommendProducts(){
            await this.$axios.get(process.env.BASE_URL+'/products/recommend').then(response => {
                this.recommendProducts = response.data;
            });
        },
        async loadSlider(){
            await this.$axios.get(process.env.BASE_URL+'/slider').then(response => {
                this.slider = response.data;
            });
        },
        // getSliderImage(){
        //     return "storage/slider/"+ this.slider
        // },
    },
    mounted() {
        this.loadPopularProducts();
        this.loadNewProducts();
        this.loadRecommendProducts();
        this.loadSlider();
    }
}
</script>

<style>

</style>
