<template>
    <div>
        <div class=" padding-y">
            <div class="container">
                <output>
                    <div class="row">
                        <div class="col-md-4">	
                            <article class="card card-body">
                                <figure class="itemside">
                                    <div class="aside">
                                        <span class="icon-sm rounded-circle bg-primary">
                                            <i class="fa fa-money-bill-alt white"></i>
                                        </span>
                                    </div>
                                    <figcaption class="info">
                                        <h6 class="title">Reasonable prices</h6>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labor </p>
                                    </figcaption>
                                </figure> <!-- iconbox // -->
                            </article> <!-- panel-lg.// -->
                        </div><!-- col // -->
                        <div class="col-md-4">
                            <article class="card card-body">
                                <figure class="itemside">
                                    <div class="aside">
                                        <span class="icon-sm rounded-circle bg-secondary">
                                            <i class="fa fa-comment-dots white"></i>
                                        </span>
                                    </div>
                                    <figcaption class="info">
                                        <h6 class="title">Customer support 24/7 </h6>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labor </p>
                                    </figcaption>
                                </figure> <!-- iconbox // -->
                            </article> <!-- panel-lg.// -->
                        </div><!-- col // -->
                        <div class="col-md-4">
                            <article class="card card-body">
                                <figure class="itemside">
                                    <div class="aside">
                                        <span class="icon-sm rounded-circle bg-success">
                                            <i class="fa fa-truck white"></i>
                                        </span>
                                    </div>
                                    <figcaption class="info">
                                        <h6 class="title">Quick delivery</h6>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labor </p>
                                    </figcaption>
                                </figure> <!-- iconbox // -->
                            </article> <!-- panel-lg.// -->
                        </div><!-- col // -->
                    </div>
                </output>
            </div>
        </div>
        <!-- ========================= FOOTER ========================= -->
        <footer class="section-footer border-top">
            <div class="container">
                <section class="footer-top padding-y">
                    <div class="row">
                        <aside class="col-md-4">
                            <article class="mr-3">
                                <nuxt-link :to="{ name: 'index' }" class="brand-wrap">
                                    <img class="logo-footer img-fluid" v-if="setting.site_logo" :src="updateImageURL(setting.site_logo)">
                                    <img class="logo-footer img-fluid" v-else src="~/static/images/logo.png">
                                </nuxt-link>
                                <p class="mt-3"> {{ setting.short_description }} </p>
                                <div>
                                    <a class="btn btn-icon btn-light" title="Facebook" target="_blank" :href="setting.facebook" v-if="setting.facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-icon btn-light" title="Instagram" target="_blank" :href="setting.instagram" v-if="setting.instagram"><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-icon btn-light" title="Youtube" target="_blank" :href="setting.youtube" v-if="setting.youtube"><i class="fab fa-youtube"></i></a>
                                    <a class="btn btn-icon btn-light" title="Twitter" target="_blank" :href="setting.twitter" v-if="setting.twitter"><i class="fab fa-twitter"></i></a>
                                </div>
                            </article>
                        </aside>
                        <aside class="col-sm-3 col-md-2">
                            <h6 class="title">About</h6>
                            <ul class="list-unstyled">
                                <li> <a href="#">About us</a></li>
                                <li> <a href="#">Services</a></li>
                                <li> <a href="#">Rules and terms</a></li>
                                <li> <a href="#">Blogs</a></li>
                            </ul>
                        </aside>
                        <aside class="col-sm-3 col-md-2">
                            <h6 class="title">Services</h6>
                            <ul class="list-unstyled">
                                <li> <a href="#">Help center</a></li>
                                <li> <a href="#">Money refund</a></li>
                                <li> <a href="#">Terms and Policy</a></li>
                                <li> <a href="#">Open dispute</a></li>
                            </ul>
                        </aside>
                        <aside class="col-sm-3  col-md-2">
                            <h6 class="title">For users</h6>
                            <ul class="list-unstyled">
                                <li> <nuxt-link :to="{ name: 'privacy-policy' }"> Privacy Policy </nuxt-link></li>
                                <li> <nuxt-link :to="{ name: 'terms-and-condition' }"> Terms and Condition </nuxt-link></li>
                                <li> <nuxt-link :to="{ name: 'refund-and-return' }"> Refund and Return </nuxt-link></li>
                                <li> <nuxt-link :to="{ name: 'shipping-and-delievery' }"> Shipping & Delivery </nuxt-link></li>
                                <li> <nuxt-link :to="{ name: 'payment-policy' }"> Payment Policy </nuxt-link></li>
                            </ul>
                        </aside>
                        <aside class="col-sm-2  col-md-2">
                            <h6 class="title">Our app</h6>
                            <a href="#" class="d-block mb-2"><img src="~/static/images/misc/appstore.png" height="40"></a>
                            <a href="#" class="d-block mb-2"><img src="~/static/images/misc/playmarket.png" height="40"></a>
                        </aside>
                    </div> <!-- row.// -->
                </section>	<!-- footer-top.// -->

                <section class="footer-copyright border-top">
                    <p class="float-left text-muted"> {{ setting.copyright }} </p>
                    <p target="_blank" class="float-right text-muted">
                        <a href="#">Privacy &amp; Cookies</a> &nbsp;   &nbsp; 
                        <a href="#">Accessibility</a>
                    </p>
                </section>
            </div><!-- //container -->
        </footer>
        <!-- ========================= FOOTER END // ========================= -->
    </div>
</template>

<script>
export default {
    components: {

    },
    data(){
        return {

        }    
    },
    methods: {
        updateImageURL(image){
            if(image){
                return this.$store.getters.updateImageURL(image);
            }
        },
    },
    mounted(){

    },
    computed: {
        setting(){
            return this.$store.getters.getSetting;
        }
    }
}
</script>

<style>

</style>
