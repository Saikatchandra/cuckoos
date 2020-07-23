<template>
    <div href="#" class="card card-product-grid">
        <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="img-wrap"> <img :src="product.image"> </nuxt-link>
        <figcaption class="info-wrap">
            <nuxt-link :to="{name: 'product-slug', params: {slug: product.slug}}" class="title">{{ product.title }}</nuxt-link>
            <div class="rating-wrap">
                <ul class="rating-stars">
                    <li style="width:80%" class="stars-active">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                </ul>
                <span class="label-rating text-muted"> 34 reviws</span>
            </div>
            <div class="price mt-1" v-if="product.sale_price">$ {{ price(product.sale_price) }}</div>
            <div class="price mt-1" v-else>$ {{ price(product.price) }}</div>
        </figcaption>
    </div>
</template>

<script>
export default {
    props: ['product'],
    methods: {
		price(value){
			return (value/100).toFixed(2);
		}
    }
}
</script>

<style>

</style>