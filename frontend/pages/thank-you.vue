<template>
    <div>
         <section class="section-content padding-y">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-5">
                        <div class="text-center py-5 jumbotron">
                            <h2 class="mb-3">Thank You! </h2>
                            <p class="">Your order placed successfully.You check your order status from account dashboard</p>
                            <div class="mt-4">
                                <nuxt-link :to="{name: 'index'}" class="btn btn-success mr-2">Continue Shopping</nuxt-link>
                                <nuxt-link :to="{name: 'customer-order'}" class="btn btn-primary">Go to Dashboard</nuxt-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>