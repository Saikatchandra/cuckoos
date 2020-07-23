<template>
    <div>
        <article class="card">
            <header class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Shipping Information</h5>
                    <a href="#" @click.prevent="addNewAddress" class="btn btn-primary btn-sm">Add new Address</a>
                </div>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="shipping-addresses">
                            <div class="row">
                                <div class="col-4 mb-3" v-for="address in addresses" :key="address.id">
                                    <div class="address rounded border pt-1 p-3" :class="{'border-primary' : shippingId == address.id,  'text-muted' : !address.default}">
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
                                <div class="col-12 text-center" v-if="!addresses.length">
                                    <h5 class="py-4">No address found</h5>
                                </div>
                            </div>
                        </div>
                        <div v-if="shippingForm" class="mt-4">
                            <hr class="mb-4">
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
                                            <input type="text" name="phone" v-model="addressForm.phone" class="form-control" placeholder="phone number" :class="{ 'is-invalid': addressForm.errors.has('phone') }">
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
                                    <button @click="cancel" class="btn btn-outline-warning">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</template>

<script>
import stateList from '@/data/states-and-districts.json';
export default {
    scrollToTop: true,
    data() {
        return {
            name: 'Shipping Address',
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
            selectedState: '',
            selectedDistrict: '',
            stateList: stateList,
            districtList: [],
        }
    },
    methods: {
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        },
        loadAddress(){
            this.$axios.get(process.env.BASE_URL+'/shipping').then(response => {
                this.addresses = response.data;
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
        cancel(){
            this.editShipping = false;
            this.shippingForm = false;
        },
        changeState(event){
            let stateName = event.target.value;
            
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
                    // this.shippingForm = false;

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

	created(){
        this.setPageName();
    },

    mounted() {
        this.loadAddress();
    }
}
</script>

<style>

</style>