<template>
    <div>
        <!-- ========================= SECTION PAGETOP ========================= -->
        <section class="section-pagetop bg">
            <div class="container">
                <h2 class="title-page">{{ category.name }}</h2>
                <nav>
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item"><nuxt-link :to="{name: 'index'}">Home</nuxt-link></li>
                        <li class="breadcrumb-item active">{{ category.name }}</li>
                    </ol>
                </nav>
            </div> <!-- container //  -->
        </section>
        <!-- ========================= SECTION INTRO END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content padding-y">
            <div class="container">
                <div class="row">
                    <aside class="col-md-3">
                        <form class="card" @submit.prevent="">
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <h6 class="title">Category </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse_1" style="">
                                    <div class="card-body">
                                        <!-- <form class="pb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <div class="input-group-append">
                                                <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form> -->
                                        <ul class="list-menu">
                                            <li v-for="category in categories" :key="category.id">
                                                <nuxt-link :to="{name: 'category-slug', params: {slug: category.slug}}">{{ category.name }} </nuxt-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <h6 class="title">Brands </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse_2" style="">
                                    <div class="card-body">
                                        <label class="custom-control custom-checkbox" v-for="brand in brands" :key="brand.id">
                                            <input type="checkbox" @change="selectBrand(brand.id)" class="custom-control-input">
                                            <div class="custom-control-label">
                                                {{ brand.name }}
                                                <b class="badge badge-pill badge-light float-right">{{ brand.product_count }}</b>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </article>
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <h6 class="title">Price range </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse_3" style="">
                                    <div class="card-body pt-5 pb-3">
                                        <client-only placeholder="Loading...">
                                            <vue-slider class="px-3" v-model="value" :enable-cross="false" :min="min" :max="max" :tooltip="'always'"></vue-slider>
                                        </client-only>
                                    </div>
                                </div>
                            </article>

                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <h6 class="title">Sizes </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse_4" style="">
                                    <div class="card-body">
                                        <label class="checkbox-btn">
                                            <input type="checkbox" @change="selectSize('sm')">
                                            <span class="btn btn-light"> XS </span>
                                        </label>

                                        <label class="checkbox-btn" @change="selectSize('sm')">
                                            <input type="checkbox">
                                            <span class="btn btn-light"> SM </span>
                                        </label>

                                        <label class="checkbox-btn" @change="selectSize('sm')">
                                            <input type="checkbox">
                                            <span class="btn btn-light"> LG </span>
                                        </label>

                                        <label class="checkbox-btn" @change="selectSize('sm')">
                                            <input type="checkbox">
                                            <span class="btn btn-light"> XXL </span>
                                        </label>
                                    </div>
                                </div>
                            </article>
                            <article class="filter-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Rating</h5>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" @change="selectrating(5)" class="custom-control-input">
                                            <div class="custom-control-label text-warning">
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            </div>
                                        </label>

                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" @change="selectrating(4)" class="custom-control-input">
                                            <div class="custom-control-label text-warning">
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </label>

                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" @change="selectrating(3)" class="custom-control-input">
                                            <div class="custom-control-label text-warning">
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            </div>
                                        </label>

                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" @change="selectrating(2)" class="custom-control-input">
                                            <div class="custom-control-label text-warning">
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            </div>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" @change="selectrating(1)" class="custom-control-input">
                                            <div class="custom-control-label text-warning">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </article>
                            <article class="filter-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Colors</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">Red </div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">Green </div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">Blue</div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">Orange</div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">Black </div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">White </div>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @change="selectColor('red')" class="custom-control-input">
                                                <div class="custom-control-label">Gray </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <div class="text-center mb-4 mt-4">
                                <button class="btn btn-primary">Apply Filter </button>
                            </div>
                        </form>
                    </aside>
                    <main class="col-md-9">
                        <header class="border-bottom mb-4 pb-3">
                        <div class="form-inline">
                            <span class="mr-md-auto">
                            </span>
                            <select class="mr-2 form-control" @change="sortProducts($event)">
                                <option value="1">Name (A-Z)</option>
                                <option value="2">Name (Z-A)</option>
                                <option value="3">Price (Low to High)</option>
                                <option value="4">Price (High to Low)</option>
                                <option value="5">Rating (Highest)</option>
                                <option value="6">Rating (Lowest)</option>
                            </select>
                            <div class="btn-group">
                                <a href="#" @click.prevent="chnageLayout(false)" :class="{'active' : layout == false}" class="btn btn-outline-secondary" data-toggle="tooltip" title="List view"> <i class="fa fa-bars"></i></a>
                                <a href="#" @click.prevent="chnageLayout(true)" :class="{'active' : layout == true }" class="btn btn-outline-secondary" data-toggle="tooltip" title="Grid view"> <i class="fa fa-th"></i></a>
                            </div>
                        </div>
                        </header><!-- sect-heading -->
                        <div class="row" v-if="layout">
                            <div class="col-4" v-for="product in sortProductItems" :key="product.id">
                                <div href="#" class="card card-product-grid">
                                    <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="img-wrap"> <img :src="product.image"> </nuxt-link>
                                    <figcaption class="info-wrap">
                                        <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="title">{{ product.title }}</nuxt-link>
                                        <div class="price mt-1" v-if="product.sale_price">$ {{ price(product.sale_price) }}</div>
                                        <div class="price mt-1" v-else>$ {{ price(product.price) }}</div>
                                        <p class="mt-3">
                                            <a href="#" @click.prevent="addToCart(product)" class="btn btn-primary btn-block"><i class="fa fa-shopping-cart"></i>
                                                <span class="text">Add to Cart</span>
                                            </a>
                                            <a href="#" @click.prevent="buyNow(product)" class="btn btn-light btn-block"><i class="fa fa-shopping-cart"></i>
                                                <span class="text">Buy Now</span>
                                            </a>
                                        </p>
                                    </figcaption>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <article class="card card-product-list" v-for="product in sortProductItems" :key="product.id">
                                <div class="row no-gutters">
                                    <aside class="col-md-3">
                                        <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="img-wrap">
                                            <span v-if="newProduct(product.created_at)" class="badge badge-danger"> NEW </span>
                                            <img :src="product.image">
                                        </nuxt-link>
                                    </aside>
                                    <div class="col-md-6">
                                        <div class="info-main">
                                            <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="h5 title"> {{ product.title }} </nuxt-link>
                                            <div class="rating-wrap mb-3">
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
                                                <div class="label-rating">7/10</div>
                                            </div>
                                            <client-only>
                                                <p> {{ stripHtml(product.description) }} </p>
                                            </client-only>
                                            <hr>
                                            <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="btn btn-light btn-block"> Details </nuxt-link>
                                        </div>
                                    </div>
                                    <aside class="col-sm-3">
                                        <div class="info-aside">
                                            <div class="price-wrap">
                                                <span class="price h5"> $ {{ price(product.sale_price) }} </span>
                                                <del class="price-old"> $ {{ price(product.price) }} </del>
                                            </div>
                                            <br>
                                            <p>
                                                <a href="#" @click.prevent="addToCart(product)" class="btn btn-primary btn-block"><i class="fa fa-cart-plus"></i>
                                                    <span class="text">Add to Cart</span>
                                                </a>
                                                <a href="#" @click.prevent="buyNow(product)" class="btn btn-warning btn-block"><i class="fa fa-shopping-cart"></i>
                                                    <span class="text">Buy Now</span>
                                                </a>
                                            </p>
                                        </div>
                                    </aside>
                                </div>
                            </article>
                        </div>
                        <nav aria-label="Page navigation sample">
                            <ul class="pagination">
                                <li class="page-item" :class="{ 'disabled' : !products.prev_page_url}"><a @click.prevent="loadCategories(products.prev_page_url)" class="page-link" href="#">Previous</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#">Page {{ products.current_page }} of {{ products.last_page }}</a></li>
                                <li class="page-item" :class="{ 'disabled' : !products.next_page_url}"><a @click.prevent="loadCategories(products.next_page_url)" class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </main>
                </div>
            </div>
        </section>
    </div>
</template>

<script>

// Sorting Products
var filters = {
    nameAtoZ: function(products) {
        // Name A to Z
        return products.sort((a, b) =>  {
            return (a.title > b.title) ? 1 : -1;
        });
    },
    nameZtoA: function(products) {
        // Name Z to A
        return products.sort((a, b) =>  {
            return (a.title > b.title) ? -1 : 1;
        });
    },
    priceLowToHigh: function(products) {
        // price Low to High
        return products.sort((a, b) =>  {
            let itemOnePrice = a.sale_price || a.price;
            let itemTwoPrice = b.sale_price || b.price;

            return (itemOnePrice > itemTwoPrice) ? 1 : -1;
        });
    },
    priceHighToLow: function(products) {
        // Price High to Low
        return products.sort((a, b) =>  {
            let itemOnePrice = a.sale_price || a.price;
            let itemTwoPrice = b.sale_price || b.price;

            return (itemOnePrice > itemTwoPrice) ? -1 : 1;
        });
    },
    ratingLowToHigh: function(products) {
        return products;
    },
    ratingHighToLow: function(products) {
        return products;
    },
};

import dayjs from 'dayjs'
export default {
    data(){
        return {
            category: {},
            products: [],
            sort: 'nameAtoZ',
            brands: [],
            value: [0, 95],
            min: 0,
            max: 1000,
            filter: {
                minPrice: 0,
                maxPrice: 0,
                searchKey: '',
                category: null,
                selectedColor:[],
                selectedSize: [],
                selectedBrand:[],
                selectedRating: [],
            }
        }
    },
    components: {
        // VueSlider
    },
    async asyncData ({ params, $axios }) {
        const { data } = await $axios.get(process.env.BASE_URL+`/category/${params.slug}`);
        return { category: data[0], products: data[1] }
    },
    methods: {
		price(value){
			return (value/100).toFixed(2);
		},
        loadCategories(pageUrl){
            pageUrl = pageUrl || process.env.BASE_URL+`/category/${params.slug}`;
            this.$axios.get(pageUrl).then(response => {
                this.products = response.data[1];
            });
        },
        chnageLayout(boxLayout){
            // let layout = JSON.parse(localStorage.getItem('layout')) || false;
            this.$store.commit('SET_POST_LAYOUT', boxLayout);
        },
        newProduct(date){
            // let createdDate = dayjs(date).format('D MMMM YYYY');

            let createdDate = dayjs(date).valueOf();
            let now = dayjs().add(30, 'day').valueOf();

            if(now > createdDate){
                return true;
            }else {
                return false;
            }
        },

        stripHtml(html){
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            let text = tmp.textContent || tmp.innerText || "";

            return text.substring(0,100)
        },

        addToCart(data){
            let product = {
                id: data.id,
                title: data.title,
                slug: data.slug,
                price: data.sale_price || data.price,
                image: data.image,
                brand_id: data.brand.id,
                brand_name: data.brand.name,
            }
            this.$store.dispatch('cart/addToCart', {
                product: product,
                quantity: 1
            });
            this.$toast.success('Product added to cart!')
        },
        buyNow(product){
            this.addToCart(product);

            this.$router.push({ name: 'cart' });
        },
        sortProducts(event){
            let value = event.target.value;

            if(value == 1){
                // Name A to Z
                this.sort = 'nameAtoZ';
            }else if(value == 2){
                // Name Z to A
                this.sort = 'nameZtoA';
            }else if(value == 3){
                // price Low to High
                this.sort = 'priceLowToHigh';
            }else if(value == 4){
                // Price High to Low
                this.sort = 'priceHighToLow';
            }else if(value == 5){
                // Rating Low to HIgh
                this.sort = 'ratingLowToHigh';
            }else if(value == 6){
                // Rating High to Low
                this.sort = 'ratingHighToLow';
            }
        },

        selectrating(rating){
            this.filter.selectedRating.push(rating);
        },
        selectBrand(brand){
            this.filter.selectedBrand.push(brand);
        },
        selectColor(color){
            this.filter.selectedColor.push(color);
        },
        selectSize(size){
            this.filter.selectedSize.push(size);
        },

        loadBrands(){
            this.$axios.get(process.env.BASE_URL+'/get/brands').then(response => {
                this.brands = response.data;
            });
        },
        searchFilter(){
            this.filter.maxPrice = this.max;
            this.filter.minPrice = this.min;

            this.$axios.get(process.env.BASE_URL+"/search/filter", this.filter).then(response => {
                console.log(response);
            });
        }
    },
    mounted(){
        this.loadBrands();

        this.value = [this.min, this.max];
    },
    computed: {
        layout(){
            return this.$store.getters.getPostLayout;
        },
        sortProductItems(){
            let products =  filters[this.sort](this.products.data);
            return products;
        },
        categories(){
            return this.$store.getters.getCategories;
        }
    }
}
</script>

<style lang="scss">
    /* Set the theme color of the component */
    $themeColor: #3167eb;

    /* import theme style */
    @import '~vue-slider-component/lib/theme/default.scss';
</style>
