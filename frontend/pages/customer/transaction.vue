<template>
    <div>
        <article class="card order-group">
            <header class="card-header">
                <b class="d-inline-block mr-3">Transaction ID: 6123456789</b>
                <span>Date: 16 December 2018</span>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-muted">Payment</h6>
                        <span class="text-success">
                            <i class="fab fa-lg fa-cc-visa"></i>
                            Visa  **** 4216  
                        </span>

                        <p>Subtotal: $356 <br>
                        Shipping fee:  $56 <br> 
                        <span class="b">Total:  $456 </span>
                        </p>
                        
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Contact</h6>
                        <p>Michael Jackson <br> +1234567890 <br> somename@gmail.com</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Shipping address</h6>
                        <p> Home 123, Building name, Street abcd,  Tashkent Uzbekistan  </p>
                    </div>
                </div> <!-- row.// -->
                <hr>
                <ul class="row">
                    <li class="col-md-4">
                        <figure class="itemside  mb-3">
                            <div class="aside"><img src="~/static/images/items/1.jpg" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">Just name of title or name goes here</p>
                                <span class="text-muted">$145 </span>
                            </figcaption>
                        </figure> 
                    </li>
                    <li class="col-md-4">
                        <figure class="itemside  mb-3">
                            <div class="aside"><img src="~/static/images/items/2.jpg" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">Just name of title or name goes here</p>
                                <span class="text-muted">$250 </span>
                            </figcaption>
                        </figure> 
                    </li>
                    <li class="col-md-4"> 
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="~/static/images/items/3.jpg" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">Just name of title or name goes here</p>
                                <span class="text-muted">$145 </span>
                            </figcaption>
                        </figure> 
                    </li>
                </ul>
            </div> <!-- card-body .// -->
        </article>
    </div>
</template>


<script>
export default {
    scrollToTop: true,
    data() {
        return {
            name: 'Order Transaction'
        }
    },
    methods: {
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        }
	},

	created(){
        this.setPageName();
    },

    computed() {

    },

    mounted() {

    }
}
</script>

<style>

</style>