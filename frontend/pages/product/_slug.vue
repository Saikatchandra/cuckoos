<template>
    <div>
        <section class="section-pagetop bg">
            <div class="container">
                <h2 class="title-page">{{ product.title }}</h2>
                <nav>
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><nuxt-link :to="{name: 'category-slug', params: {slug: product.category.slug }}">{{ product.category.name }}</nuxt-link></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ product.title }}</li>
                    </ol>  
                </nav>
            </div>
        </section>
        <section class="padding-y-lg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row no-gutters">
                                <aside class="col-md-6">
                                    <article class="gallery-wrap">
                                        <div class="img-big-wrap">
                                            <a href="#" @click.prevent><img :src="image || product.image"></a>
                                        </div>
                                        <div class="thumbs-wrap mb-0">
                                            <a href="#" @click.prevent="productImage(product.image)" class="item-thumb"> 
                                                <img :src="product.image" style="min-width: 100%; min-height: 100%; object-fit:cover;">
                                            </a>
                                            <a href="#" @click.prevent="productImage(gallery.image)" v-for="gallery in product.galleries" :key="gallery.id" class="item-thumb"> 
                                                <img :src="gallery.image" style="min-width: 100%; min-height: 100%; object-fit:cover;">
                                            </a>
                                        </div>
                                    </article>
                                </aside>
                                <main class="col-md-6 border-left">
                                    <article class="content-body">
                                        <h2 class="title">{{ product.title }}</h2>
                                        <div class="rating-wrap my-3">
                                            <ul class="rating-stars">
                                                <li style="width:80%" class="stars-active">
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                            </ul>
                                            <small class="label-rating text-muted">132 reviews</small>
                                            <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
                                        </div>

                                        <div class="mb-3" v-if="product.sale_price">
                                            <var class="price h4">$ {{ productPrice(product.sale_price) }} </var>
                                            <var style="text-decoration: line-through" class="price h5 text-muted">$ {{ productPrice(product.price) }}</var>
                                        </div>
                                        <div class="mb-3" v-else>
                                            <var class="price h4">$ {{ productPrice(product.price) }} </var>
                                        </div>

                                        <dl class="row">
                                            <dt class="col-sm-3">Category</dt>
                                            <dd class="col-sm-9">
                                                <nuxt-link :to="{name: 'category-slug', params: {slug: product.category.slug}}">{{ product.category.name }}</nuxt-link>
                                            </dd>
                                            <dt class="col-sm-3">Brand</dt>
                                            <dd class="col-sm-9">{{ product.brand.name }}</dd>
                                        </dl>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md flex-grow-0">
                                                <label>Quantity</label>
                                                <div class="input-group mb-3 input-spinner">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-light" type="button" id="button-plus" @click="incrementQty"> + </button>
                                                    </div>
                                                    <input type="text" class="form-control" v-model="qty">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-light" type="button" id="button-minus" @click="decrementQty"> − </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md">
                                                <label>Select size</label>
                                                <div class="mt-1">
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="select_size" checked="" class="custom-control-input">
                                                        <div class="custom-control-label">Small</div>
                                                    </label>

                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="select_size" class="custom-control-input">
                                                        <div class="custom-control-label">Medium</div>
                                                    </label>

                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="select_size" class="custom-control-input">
                                                        <div class="custom-control-label">Large</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-lg btn-primary" @click.prevent="addToCart"> <span class="text">Add to cart</span> <i
                                            class="fas fa-shopping-cart"></i> </a>
                                        <a href="#" @click.prevent="buyNow(product);" class="btn btn-lg btn-outline-primary"> Buy now </a>
                                    </article>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container padding-top-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"> Information</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" v-html="product.description"> </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" v-html="product.information"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="padding-y-lg ">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-4 text-muted">Ratings & Review</h2>
                        <div v-for="rating in ratings.data" :key="rating.id">
                            <div class="row">
                                <div class="col-3">
                                    <div class="icontext align-items-start mr-4" style="max-width: 300px;">
                                        <img v-if="rating.user && rating.user.avatar" class="icon icon-md rounded-circle" :src="updateImageURL(rating.user.avatar)">
                                        <img v-else class="icon icon-md rounded-circle" src="~/static/images/avatars/user.png">
                                        <div class="text">
                                            <h6 class="title mb-2">{{ rating.user.name }}</h6>
                                            <p class="text-muted"> {{ formatDate(rating.created_at) }} </p>
                                            <Rating :stars="rating.star" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <p>{{ rating.feedback }}</p>
                                </div>
                            </div>
                            <hr class="mb-5 mt-5">
                        </div>
                        <div class="text-center" v-if="ratings.data && ratings.data.length">
                            <a href="#" @click.prevent="loadMore" :class="{'disabled': !ratings.next_page_url}" class="btn btn-primary">Load More</a>
                        </div>
                        <div class="text-center" v-else>
                            No rating yet.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="padding-y-lg bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-4 text-muted">Related Products</h2>
                        <client-only v-if="similarProducts.length">
                            <carousel :autoplay="true" :nav="false" :items="3" :margin="30">
                                <div v-for="product in similarProducts" :key="product.id">
                                    <Product :product="product" />
                                </div>
                            </carousel>
                        </client-only>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>

<script>
import Product from '@/components/Product'
import Rating from '@/components/Rating';
import dayjs from 'dayjs';

export default {
    head: {
        title: 'Product Details Page',
    },
    components: {
        Product,
        Rating,
    },
    data(){
        return {
            image: '', 
            product: {},
            similarProducts: [],
            qty: 1,
            ratings: [],
        }
    },
    async asyncData ({ params, $axios }) {
        const { data } = await $axios.get(process.env.BASE_URL+`/product/${params.slug}`);
        return { product: data}
    },
    methods: {
        loadSimilarProducts(){
            this.$axios.get(process.env.BASE_URL+'/products/related/'+this.product.slug).then(response => {
                this.similarProducts = response.data;
            });
        },
        productImage(image){
            return this.image = image || this.product.image
        },
        productPrice(value){
			return (value/100).toFixed(2);
        },
        incrementQty(){
            this.qty++;
        },
        decrementQty(){
            if(this.qty > 1){
                this.qty--;
            }
        },
        addToCart(){
            let product = {
                id: this.product.id,
                title: this.product.title,
                slug: this.product.slug,
                price: this.product.sale_price || this.product.price,
                image: this.product.image,
                brand_id: this.product.brand.id,
                brand_name: this.product.brand.name,
            }
            this.$store.dispatch('cart/addToCart', { 
                product: product,
                quantity: this.qty
            });
            this.qty = 1;

            this.$toast.success('Product added to cart!')
        },
        loadRatings(){
            this.$axios.get(process.env.BASE_URL+'/ratings/'+this.product.id).then(response => {
                this.ratings = response.data;
            });
        },
        
        formatDate(date){
            return dayjs(date).format('D MMMM YYYY');
        },
        loadMore(){
            this.$axios.get(this.ratings.next_page_url).then(response => {
                this.ratings.next_page_url = response.data.next_page_url;

                response.data.data.forEach(element => {
                    this.ratings.data.push(element);
                });
            });
        },
        updateImageURL(image){
            if(image){
                return this.$store.getters.updateImageURL(image);
            }
        },
        buyNow(product){
            this.addToCart(product);

            this.$router.push({ name: 'cart' });
        },
    },
    mounted() {
        this.loadSimilarProducts();
        this.loadRatings();
    }
}
</script>

<style>

</style>
