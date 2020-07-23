<template>
    <div>
        <!-- ========================= SECTION PAGETOP ========================= -->
        <section class="section-pagetop bg">
            <div class="container">
                <h2 class="title-page"> Checkout </h2>
            </div> <!-- container //  -->
        </section>
        <!-- ========================= SECTION INTRO END// ========================= -->

        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content padding-y">
            <div class="container">
                <div class="row">
                    <main class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-4"> Shipping Address </h4>
                                    <a href="#" @click.prevent="addNewAddress" class="btn btn-primary btn-sm">Add new Address</a>
                                </div>
                                <div class="shipping-addresses">
                                    <div class="row">
                                        <div class="col-4 mb-3" v-for="address in addresses" :key="address.id">
                                            <div class="address rounded border pt-1 p-3" :class="{'border-primary' : shippingId == address.id,  'text-muted' : !address.default}" @click="selectAddress(address.id)">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div v-if="address.default" class="badge badge-primary">default</div>
                                                    <div v-else></div>
                                                    <div class="text-right">
                                                        <a href="#" @click.stop.prevent="editAddress(address)" class="badge text-muted action">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <a href="#" @click.stop.prevent="deleteAddress(address)" class="badge text-muted action">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <p class="mb-1">{{ address.name }}</p> 
                                                <p class="mb-0">{{ address.address }}</p> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" v-if="shippingForm">
                                <h5 v-if="editShipping">Edit Shipping Address </h5>
                                <h5 v-else>Add New Shpping </h5>
                                <form @submit.prevent="saveAddress()">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Name </label>
                                                <input type="text" name="name" v-model="addressForm.name" class="form-control" placeholder="holder name" :class="{ 'is-invalid': addressForm.errors.has('name') }">
						                        <has-error :form="addressForm" field="name"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Phone Number </label>
                                                <input type="text" name="phone_number" v-model="addressForm.phone" class="form-control" placeholder="phone number" :class="{ 'is-invalid': addressForm.errors.has('phone') }">
						                        <has-error :form="addressForm" field="phone"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> State list </label>
                                                <select name="state" @change="changeState($event)" v-model="addressForm.state" class="form-control" :class="{ 'is-invalid': addressForm.errors.has('state') }">
                                                    <option value="" style="display:none" selected>Select State</option>
                                                    <option :value="state.state" v-for="state in stateList.states" :key="state.id"> {{ state.state }} </option>
                                                </select>
						                        <has-error :form="addressForm" field="state"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> District list </label>
                                                <select name="district" class="form-control" v-model="addressForm.district" :class="{ 'is-invalid': addressForm.errors.has('district') }">
                                                    <option value="" style="display:none" selected> Select District </option>
                                                    <option v-for="district in districtList" :key="district.id" :value="district.name">{{ district.name }}</option>
                                                </select>
						                        <has-error :form="addressForm" field="district"></has-error>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Postal code </label>
                                                <input type="text" name="postal_code" v-model="addressForm.postal_code" class="form-control" placeholder="postal code" :class="{ 'is-invalid': addressForm.errors.has('postal_code') }">
						                        <has-error :form="addressForm" field="postal_code"></has-error>
                                            </div>
                                        </div>                                        
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label> Make Default Address </label>
                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                    <input type="checkbox" class="custom-control-input" id="makeDefault" v-model="addressForm.default">
                                                    <label class="custom-control-label" for="makeDefault">Default Address</label>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label> Address </label>
                                                <textarea name="address" id="address" v-model="addressForm.address" rows="4" class="form-control" placeholder="address" :class="{ 'is-invalid': addressForm.errors.has('address') }"></textarea>
						                        <has-error :form="addressForm" field="address"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" v-if="editShipping" class="btn btn-success">Update Shipping Address</button>
                                        <button type="submit" v-else class="btn btn-success"> Add new shippping address </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="alert alert-success mt-3">
                            <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                        </div>
                    </main>
                    <aside class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Total price:</dt>
                                    <dd class="text-right">USD {{ subTotalPrice }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Shipping:</dt>
                                    <dd class="text-right">USD 0.00</dd>
                                </dl>
                                <dl class="dlist-align" v-if="Object.keys(deductedPoints).length">
                                    <dt>Deducted (Points) :</dt>
                                    <dd class="text-right"> - USD {{ (deductedPoints.money).toFixed(2) }}</dd>
                                </dl>
                                <dl class="dlist-align" v-if="Object.keys(coupon).length">
                                    <dt>Discount:</dt>
                                    <dd class="text-right"> - {{ discountAmount }}</dd>
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
                            <div class="card-body border-top text-center">
                                <a href="#" @click.prevent="purchase()" class="btn btn-primary" :class="{'disabled' : !shippingId}"> Purchase <i class="fa fa-chevron-right"></i> </a>
                            </div>
                        </div> <!-- card .// -->
                    </aside>
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
import { mapGetters } from 'vuex'
import stateList from '@/data/states-and-districts.json';

export default {
    middleware: 'auth',
    head(){
        return {
            title: 'Checkout Page | Coockus.in',
            meta: [
                { hid: 'description', name: 'description', content: 'Home page description' },
                { hid: 'keyword', name: 'keywords', content: 'Home, page, description,' }
            ],
            script: [
                { src: 'https://checkout.razorpay.com/v1/checkout.js' },
            ]
        }
    },
    data(){
        return {
            editShipping: false,
            shippingForm: false,
            addresses: [],
            shippingId: 0,
            addressForm: this.$vform({
                id: '',
				name: '',
				phone: '',
				postal_code: '',
				default: false,
				address: '',
                state: '',
                district: '',
			}),
            stateList: stateList,
            districtList: [],
        }
    },
    methods: {
        loadAddress(){
            this.$axios.get(process.env.BASE_URL+'/shipping').then(response => {
                this.addresses = response.data;
                this.shippingId = this.addresses[0].id
            });
        },

        editAddress(address){
            this.editShipping = true;
            this.shippingForm = true;
            
            this.addressForm.id = address.id;
            this.addressForm.name = address.name;
            this.addressForm.phone = address.phone;
            this.addressForm.postal_code = address.postal_code;
            this.addressForm.default = address.default;
            this.addressForm.address = address.address;
            this.addressForm.state = address.state;
            this.addressForm.district = address.district;
            
            this.loadDistrict(address.state);
        },

        clearForm(){
            this.addressForm.name = '';
            this.addressForm.phone = '';
            this.addressForm.postal_code = '';
            this.addressForm.default = false;
            this.addressForm.address = '';
            this.addressForm.state = '';
            this.addressForm.district = '';
        },

        async saveAddress(){
            if(this.editShipping){
                try {
                    await this.addressForm.post(process.env.BASE_URL+'/shipping/'+this.addressForm.id).then(response => {
                        this.clearForm();

                        this.addresses = response.data;
                        this.editShipping = false;
                        this.shippingForm = false;
                        this.$toast.success('Shipping address updated successfully!');
                        this.shippingId = this.addresses[0].id
                    });
                }catch(e){
                    console.log(e);
                }
            }else {
                try {
                    await this.addressForm.post(process.env.BASE_URL+'/shipping').then(response => {
                        this.clearForm();

                        this.shippingForm = false;
                        this.$toast.success('Shipping address added successfully!');

                        this.addresses = response.data;
                        this.shippingId = this.addresses[0].id
                    });
                }catch(e){
                    console.log(e);
                }
            }
        },

        async deleteAddress(address){
            try {
                await this.$axios.get(process.env.BASE_URL+'/shipping/delete/'+address.id).then(response => {
                    let index = this.addresses.indexOf(address);
                    this.addresses.splice(index, 1);
                    
                    if(this.addressForm.id == address.id){
                        this.clearForm();
                    }

                    this.$toast.success('Shipping address deleted successfully!');
                });
            }catch(e){
                console.log(e);
            }
        },
        addNewAddress(){
            this.editShipping = false;
            this.clearForm();
            this.shippingForm = true;
        },

        selectAddress(address){
            this.shippingId = address;
        },
        
        purchase(){
            var vm = this;
            var options = {
                "key": process.env.RAZORPAY_KEY,
                "amount": Math.round(vm.totalPrice * 100), // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "name": "Cuckoos E-Commerce",
                "description": "Purchase Transaction",
                "image": "",
                "handler": function (response){
                    vm.$axios.post(process.env.BASE_URL+'/order', {
                        shippingId: vm.shippingId,
                        items: vm.cartItems,
                        coupon: vm.coupon,
                        payment_id: response.razorpay_payment_id,
                    }).then(response => {
                        vm.$toast.success('Your order placed successfully!');
                        vm.$router.push({name: 'thank-you'});
                        
                        let items = [];
                        vm.$store.commit('cart/SET_CART_PRODUCTS', items); 
                        localStorage.setItem('cartProducts',  JSON.stringify(items));
                    });
                },
                "prefill": {
                    "name": vm.loggedInUser.name,
                    "email": vm.loggedInUser.email,
                    "contact": vm.loggedInUser.phone
                },
            };
            var rzp1 = new Razorpay(options);

            rzp1.open();


            // vm.$axios.post(process.env.BASE_URL+'/order', {
            //     shippingId: vm.shippingId,
            //     items: vm.cartItems,
            //     payment_id: 'pay_F0Nfd4zS8wmItN',
            //     deducted_points: vm.deductedPoints,
            //     coupon: vm.coupon,
            // }).then(response => {
            //     // vm.$toast.success('Your order placed successfully!');
            //     // vm.$router.push({name: 'thank-you'});
                
            //     // let items = [];
            //     // vm.$store.commit('cart/SET_CART_PRODUCTS', items); 
            //     // localStorage.setItem('cartProducts',  JSON.stringify(items));
            // });
        },

        changeState(event){
            let stateName = event.target.value;
            
            this.addressForm.district = '';
            this.loadDistrict(stateName);
        },

        loadDistrict(stateName){
            if(stateName){
                let state = this.stateList.states.find(element => {
                    return element.state == stateName;
                });
                if(state){
                    this.districtList = state.districts;
                }
            }
        }
    },
    watch: {
        addresses: {
            handler(val, oldVal){
                if(val.length){
                    let item = val.find(element => {
                        return element.id == this.shippingId;
                    });

                    if(!item){
                        this.shippingId = null;
                    }
                }else {
                    this.shippingForm = true;
                    this.editShipping = false;
                    this.shippingId = false;
                }
            },
            deep: true
        },
    },
    computed: {
		...mapGetters(['isAuthenticated', 'loggedInUser']),

        subTotalPrice() {
            return this.$store.getters['cart/subTotalPrice'];
        },
        totalPrice() {
            return this.$store.getters['cart/totalPrice'];
        },
        discountAmount() {
            return this.$store.getters['cart/discountAmount'];
        },
        coupon(){
            return this.$store.getters['cart/getCoupon'];
        },
        cartItems() {
            let products = this.$store.getters['cart/getCartProducts'];
            this.items = products;
            return products;
        },
        deductedPoints(){
            return this.$store.getters['cart/getDeductedPoints'];
        }
    },
    mounted(){
        this.loadAddress();
    }
}
</script>

<style lang="scss">
    .address {
        cursor: pointer;
        &.active, &:hover{
            border-color: #3167eb !important;
        }
        .action {
            &:hover {
                color: #3167eb !important;
            }
        }
    }
</style>