<template>
    <div>
        <article class="card">
            <header class="card-header"> Submit Information </header>
            
            <div class="card-body py-5 text-center" v-if="kycEdit">
                <div v-if="user.kyc_verification">
                    <!-- <h5 class="text-center mb-4"> You have submitted your document. </h5> -->
                    <div class="btn btn-success"> Your information has been verified </div>
                    <div>
                        <small> <a href="#" data-toggle="modal" data-target="#editAccess"> Request Edit Access </a> </small>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="editAccess" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editAccessLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form @submit.prevent="giveAccessToEdit">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAccessLabel">Warning</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="text-success text-center">Your acount is verified, If you proceed to edit. Your future withdraw request will be ignored until your document is verified again. </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">I don't need to edit anymore.</button>
                                        <button type="submit" class="btn btn-primary">I Understand</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <h5 class="text-center mb-4"> You have submitted your document. </h5>
                    <a href="#" @click="editKyc()" class="btn btn-primary">Edit Your Info</a>
                </div>
            </div>
            <div class="card-body" v-else>
                <form @submit.prevent="submitInfo" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">PAN Card</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="verifyForm.pan_card" placeholder="Pan card" :class="{ 'is-invalid': verifyForm.errors.has('pan_card') }">
                                    <has-error :form="verifyForm" field="pan_card"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">PAN Card Image</label>
                                <div class="input-group">
                                    <input type="file" name="pan_card_image" class="form-control-file" @change="onPenCardImageChange" :class="{ 'is-invalid': verifyForm.errors.has('pan_card_image') }">
                                    <has-error :form="verifyForm" field="pan_card_image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Aadhaar Card</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="verifyForm.aadhaar_card" placeholder="Aadhaar card" :class="{ 'is-invalid': verifyForm.errors.has('aadhaar_card') }">
                                    <has-error :form="verifyForm" field="aadhaar_card"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Aadhaar Card Image</label>
                                <div class="input-group">
                                    <input type="file" name="aadhaar_card_image"  class="form-control-file" @change="onAdhaarCardImageChange" :class="{ 'is-invalid': verifyForm.errors.has('aadhaar_card_image') }">
                                    <has-error :form="verifyForm" field="aadhaar_card_image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="verifyForm.ifsc_code" placeholder="IFSC code" :class="{ 'is-invalid': verifyForm.errors.has('ifsc_code') }">
                                    <has-error :form="verifyForm" field="ifsc_code"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="verifyForm.full_name" placeholder="Full Name" :class="{ 'is-invalid': verifyForm.errors.has('full_name') }">
                                    <has-error :form="verifyForm" field="full_name"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Select Bank</label>
                                <div class="input-group">
                                    <select name="bank" id="" class="form-control" v-model="verifyForm.bank_ac_name" :class="{ 'is-invalid': verifyForm.errors.has('bank_ac_name') }">
                                        <option value="" style="display: none" selected>Select Bank</option>
                                        <option v-for="bank in bankList" :key="bank.id" :value="bank.name">{{ bank.name }}</option>
                                    </select>
                                    <has-error :form="verifyForm" field="bank_ac_no"></has-error>
                                </div> 
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Bank Account NO</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="verifyForm.bank_ac_no" placeholder="Bank account no" :class="{ 'is-invalid': verifyForm.errors.has('bank_ac_no') }">
                                    <has-error :form="verifyForm" field="bank_ac_no"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary"> Submit information </button>
                    </div>
                </form>
            </div>
        </article>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { objectToFormData } from 'object-to-formdata';
import bankList from '@/data/bank-list.json';

export default {
    scrollToTop: true,
    data(){
        return {
            name: 'Verify Your Account',
            user: {},
            referrals: 0,
            bankList: bankList,
            kyc: {},
            kycEdit: false,
            verifyForm: this.$vform({
                pan_card: '',
                pan_card_image: '',
                aadhaar_card: '',
                aadhaar_card_image: '',
                ifsc_code: '',
                bank_ac_name: '',
                bank_ac_no: '',
                full_name: '',
            }),
            updateKyc: false,
        }
    },
    // async asyncData({$axios}){
        
    // },
    methods: {
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        },
        copyTestingCode () {
            let testingCodeToCopy = document.querySelector('#referralLInk')
            testingCodeToCopy.select()

            try {
                var successful = document.execCommand('copy');
            } catch (err) {
                alert('Oops, unable to copy');
            }

            /* unselect the range */
            window.getSelection().removeAllRanges()
        },
        loadUser(){
            this.$axios.get(process.env.BASE_URL+'/user').then(response => {
                this.user = response.data[0];
                this.referrals = response.data[1];
            });

        },

        loadKycInfo(){
            this.$axios.get(process.env.BASE_URL+'/get/kyc').then(response => {
                this.kyc = response.data;
                if(Object.keys(response.data).length){
                    this.kycEdit = true;
                }else {
                    this.kycEdit = false;
                }
            });
        },
        
        onPenCardImageChange(e){
            this.verifyForm.pan_card_image = e.target.files[0];
        },

        onAdhaarCardImageChange(e){
            this.verifyForm.aadhaar_card_image = e.target.files[0];
        },

        async submitInfo(){         
            if(this.updateKyc){
                await this.verifyForm.post(process.env.BASE_URL+'/affiliate/update', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],

                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                    }
                }).then(response => {
                    this.$toast.success('Your KYC information updated successfully!');
                    this.kycEdit = true;
                    
                    this.kyc = response.data[0];
                    this.user = response.data[1];
                });  
            }else {
                await this.verifyForm.post(process.env.BASE_URL+'/affiliate/verify', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],

                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                    }
                }).then(response => {
                    this.$toast.success('Your KYC information saved successfully!');
                    this.kycEdit = true;
                });
            }
        },
        editKyc(){
            this.kycEdit = false;
            this.updateKyc = true;
            this.verifyForm.pan_card = this.kyc.pan_card;
            this.verifyForm.aadhaar_card = this.kyc.aadhaar_card;
            this.verifyForm.ifsc_code = this.kyc.ifsc_code;
            this.verifyForm.bank_ac_name = this.kyc.bank_ac_name;
            this.verifyForm.bank_ac_no = this.kyc.bank_ac_no;
            this.verifyForm.full_name = this.kyc.full_name;
        },

        giveAccessToEdit(){
            $('#editAccess').modal('hide');
            this.kycEdit = false;
            this.updateKyc = true;
            this.verifyForm.pan_card = this.kyc.pan_card;
            this.verifyForm.aadhaar_card = this.kyc.aadhaar_card;
            this.verifyForm.ifsc_code = this.kyc.ifsc_code;
            this.verifyForm.bank_ac_name = this.kyc.bank_ac_name;
            this.verifyForm.bank_ac_no = this.kyc.bank_ac_no;
            this.verifyForm.full_name = this.kyc.full_name;
        }
	},

	created(){
        this.setPageName();
    },

    computed: {
		...mapGetters(['isAuthenticated', 'loggedInUser']),
    },

    mounted(){
        this.loadUser();
        this.loadKycInfo();
    }
}
</script>

<style>

</style>