<template>
    <div>
        <!-- ========================= SECTION PAGETOP ========================= -->
        <section class="section-pagetop bg">
            <div class="container">
                <h2 class="title-page">Shopping cart</h2>
            </div> <!-- container //  -->
        </section>
        <!-- ========================= SECTION INTRO END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content padding-y">
            <div class="container">
                <div class="row">
                    <main class="col-md-9" v-if="cartItems && cartItems.length">
                        <div class="card">
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col">Product</th>
                                        <th scope="col" width="120">Quantity</th>
                                        <th scope="col" width="120">Price</th>
                                        <th scope="col" class="text-right" width="200"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in cartItems" :key="item.id">
                                        <td>
                                            <figure class="itemside">
                                                <div class="aside"><img :src="item.product.image" class="img-sm"></div>
                                                <figcaption class="info">
                                                    <nuxt-link :to="{name: 'product-slug', params: {slug: item.product.slug }}" class="title text-dark">{{ item.product.title }}</nuxt-link>
                                                    <!-- <p class="text-muted small">Size: XL, Color: blue, <br> Brand: Gucci</p> -->
                                                    <p class="text-muted small">Brand: {{ item.product.brand_name }}</p>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td>
                                            <div class="form-group col-md flex-grow-0">
                                                <div class="input-group mb-3 input-spinner">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-light" type="button" id="button-plus" @click="incrementQty(item)"> + </button>
                                                    </div>
                                                    <input type="text" class="form-control" v-model="item.qty">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-light" type="button" id="button-minus" @click="decrementQty(item)"> − </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price">${{ productTotalPrice(item.product.price, item.qty) }}</var>
                                                <small class="text-muted"> ${{ productPrice(item.product.price) }} each </small>
                                            </div> <!-- price-wrap .// -->
                                        </td>
                                        <td class="text-right">
                                            <!-- <a href="" class="btn btn-light" data-toggle="tooltip" data-placement="left" title="Tooltip on left"> <i class="fa fa-heart"></i></a> -->
                                            <a href="" @click.prevent="removeCartItem(item)" class="btn btn-light"> Remove</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-body border-top">
                                <nuxt-link :to="{name: 'checkout'}" class="btn btn-primary float-md-right"> Make Purchase <i class="fa fa-chevron-right"></i> </nuxt-link>
                                <nuxt-link :to="{name: 'index'}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </nuxt-link>
                            </div>
                        </div> <!-- card.// -->
                        <div class="alert alert-success mt-3">
                            <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                        </div>
                    </main> <!-- col.// -->
                    <main class="col-md-9" v-else>
                        <div class="card">
                            <div class="card-body text-center pt-5 pb-5">
                                <p class="mb-4">You don't have anything in your cart yet!</p>
                                <nuxt-link :to="{name: 'index'}" class="btn btn-primary"> <span class="text"> Continue to Shopping</span> <i class="fa fa-shopping-cart"></i> </nuxt-link>
                            </div>
                        </div>
                    </main>
                    <aside class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Subtotal price:</dt>
                                    <dd class="text-right">USD {{ subTotalPrice }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Shipping:</dt>
                                    <dd class="text-right">USD 0.00</dd>
                                </dl>
                                <dl class="dlist-align" v-if="Object.keys(coupon).length">
                                    <dt>Discount:</dt>
                                    <dd class="text-right"> - USD {{ discountAmount }}</dd>
                                </dl>
                                <dl class="dlist-align" v-if="Object.keys(deductedPoints).length">
                                    <dt>Deducted (Points) :</dt>
                                    <dd class="text-right"> - USD {{ (deductedPoints.money).toFixed(2) }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd class="text-right  h5"><strong>USD {{ totalPrice }}</strong></dd>
                                </dl>
                                <hr>
                                <p class="text-center mb-3">
                                    <img src="images/misc/payments.png" height="26">
                                </p>
                            </div> <!-- card-body.// -->
                        </div> <!-- card .// -->
                        <div class="card mt-3">
                            <div class="card-body">
                                <form @submit.prevent="applyCoupon">
                                    <div class="form-group">
                                        <label>Have coupon?</label>
                                        <div class="input-group" v-if="Object.keys(coupon).length">
                                            <input type="text" class="form-control" name="coupon_code" v-model="coupon.code" placeholder="Coupon code" :readonly="coupon.code">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary disabled">Apply</button>
                                            </span>
                                            <a href="#" @click.prevent="removeCoupon" class="help-block invalid-feedback d-block">Remove Coupon</a>
                                        </div>
                                        <div class="input-group" v-else>
                                            <input type="text" class="form-control" name="coupon_code" v-model="couponCode" placeholder="Coupon code">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- card-body.// -->
                        </div> <!-- card .// -->
                        <div class="card mt-3" v-if="Object.keys(wallet).length">
                            <div class="card-body">
                                <form @submit.prevent="applyPoints">
                                    <div class="form-group">
                                        <label>Have Points?</label>
                                        <div v-if="Object.keys(deductedPoints).length">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="points" v-model="deductedPoints.points" placeholder="Enter points" readonly>
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-primary disabled">Apply</button>
                                                </span>
                                                <a href="#" @click.prevent="removePoints" class="help-block invalid-feedback d-block">Remove Points</a>
                                            </div>
                                            <div class="mt-2">You have {{ wallet.balance }} points.</div>
                                        </div>
                                        <div v-else>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="points" v-model="points" placeholder="Enter points">
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Apply</button>
                                                </span>
                                            </div>
                                            <div class="mt-2">You have {{ wallet.balance }} points.</div>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- card-body.// -->
                        </div> <!-- card .// -->
                    </aside> <!-- col.// -->
                </div>
            </div> <!-- container .//  -->
        </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->

        <!-- ========================= SECTION  ========================= -->
        <section class="section-name bg padding-y">
            <div class="container">
                <h6>Payment and refund policy</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div><!-- container // -->
        </section>
        <!-- ========================= SECTION  END// ========================= -->
    </div>
</template>

<script>
import dayjs from 'dayjs';
export default {
    data(){
        return {
            qty: 1,
            couponCode: '',
            points: '',
            deducted_amount: 0,
        }
    },
    methods: {
        incrementQty(product){
            this.qty = product.qty;
            this.qty +=1;
            
            this.$store.dispatch('cart/updateCartItem', {
                product: product,
                quantity: this.qty,
            });

            this.$toast.success('Product quantity updated!');
        },
        decrementQty(product){
            this.qty = product.qty;

            if(product.qty > 1){
                this.qty -=1;
                
                this.$store.dispatch('cart/updateCartItem', {
                    product: product,
                    quantity: this.qty,
                });   

                this.$toast.success('Product quantity updated!');
            }else {
                this.$toast.warning('Product minimum quantity must be 1!');
            }
        },
        productPrice(value){
			return (value/100).toFixed(2);
        },
        productTotalPrice(price, qty){
            let totalPrice = price * qty
            return (totalPrice/100).toFixed(2);
        },
        removeCartItem(product){
            this.$store.dispatch('cart/removeCartItem', product);
            
            this.$toast.success('Product removed from cart!');
        },
        applyCoupon(){
            // backend is checking coupon maximum 
            // user limit
            // usages limit
            // new user avility
            // expiry date
            // active status 

            // frontend must check min_spend amount & free shipping 
            this.$axios.post(process.env.BASE_URL+'/coupon/check', {coupon: this.couponCode }).then(response => {
                let data = response.data;
                let coupon = data.coupon;

                // console.log(data);
                if(coupon.min_spend < this.subTotalPrice){
                    if(data.error){
                        this.couponCode = '';
                        this.$toast.error('Error - '+ data.message);
                    }else {
                        if(coupon.status){
                            // Save coupon on store
                            this.$store.commit('cart/SET_COUPON', coupon);
                            this.$toast.success('Success - Coupon applied in your cart');
                        }else {
                            this.couponCode = '';
                            this.$toast.error('Error - Coupon is not active');
                        }
                    }
                }else {
                    this.couponCode = '';
                    this.$toast.error('Error - You need to have at least '+ coupon.min_spend + ' amount in your cart.', {duration: 10000});
                }
            }).catch(response => {
                this.couponCode = '';
                this.$toast.error('Error - Coupon not found');
            });
        },
        removeCoupon(){
            this.couponCode = '';
            this.$store.commit('cart/SET_COUPON', {});
            this.$toast.success('Success - Coupon removed from your cart');
        },
        applyPoints(){
            this.$axios.post(process.env.BASE_URL+'/check/points', {points: this.points, total: this.subTotalPrice}).then(response => {
                this.$store.commit('cart/SET_DEDUCTED_POINTS', response.data); 
                this.$toast.success('Success - Points applied in your cart');
            });
        },
        removePoints(){
            this.points = '',
            this.$store.commit('cart/SET_DEDUCTED_POINTS', {}); 
            this.$toast.success('Success - Points removed from your cart');
        },
    },
    computed: {
        cartItems() {
            let products = this.$store.getters['cart/getCartProducts'];
            this.items = products;
            return products;
        },
        coupon(){
            return this.$store.getters['cart/getCoupon'];
        },
        subTotalPrice(){
            return this.$store.getters['cart/subTotalPrice'];
        },
        totalPrice(){
            return this.$store.getters['cart/totalPrice'];
        },
        discountAmount(){
            return this.$store.getters['cart/discountAmount'];
        },
		wallet(){
            return this.$store.getters.getWallet;
		},
        deductedPoints(){
            return this.$store.getters['cart/getDeductedPoints'];
        }
    },

    mounted() {
        
    }
}
</script>

<style>

</style>
