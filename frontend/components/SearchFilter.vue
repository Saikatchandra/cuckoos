<template>
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
</template>

<script>
export default {

}
</script>

<style>

</style>