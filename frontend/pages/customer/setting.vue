<template>
    <div>
        <article class="card">
            <header class="card-header"> My Setting </header>
            <div class="card-body">
                <form @submit.prevent="updateUser">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" v-model="user.name" :class="{ 'is-invalid': user.errors.has('name') }" readonly>
                                <has-error :form="user" field="name"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" v-model="user.email" :class="{ 'is-invalid': user.errors.has('email') }">
                                <has-error :form="user" field="email"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="phone" v-model="user.phone" :class="{ 'is-invalid': user.errors.has('phone') }">
                                <has-error :form="user" field="phone"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" v-model="user.dob" :class="{ 'is-invalid': user.errors.has('dob') }">
                                <has-error :form="user" field="dob"></has-error>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Choose Avatar</label>
                                <input type="file" class="form-control-file" name="avatar" placeholder="avatar" @change="onAvatarChange" :class="{ 'is-invalid': user.errors.has('avatar') }">
                                <has-error :form="user" field="avatar"></has-error>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" v-model="user.password" placeholder="Enter password if you want to update" :class="{ 'is-invalid': user.errors.has('password') }">
                                        <has-error :form="user" field="password"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="username" v-model="user.username" :class="{ 'is-invalid': user.errors.has('username') }">
                                        <has-error :form="user" field="username"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</template>

<script>
import dayjs from 'dayjs'
import { objectToFormData } from 'object-to-formdata'

export default {
    scrollToTop: true,
    data(){
        return {
            name: 'Settings',
            user: this.$vform({
				name: '',
				email: '',
				password: '',
                phone: '',
                dob: '',
                avatar: '',
                username: '',
			}),
        }
    },

    methods: {
        setPageName(){
            this.$store.commit('SET_NAME', this.name);
        },
        
        async getUser(){
            await this.$axios.get(process.env.BASE_URL+'/auth/user').then(response => {
                this.user.name = response.data.name;
				this.user.email = response.data.email;
				this.user.password = response.data.password;
                this.user.phone = response.data.phone;
                this.user.avatar = response.data.avatar;
                this.user.username = response.data.username;
                this.user.dob = dayjs(response.data.dob).format('YYYY-MM-DD');
            });
        },

        async updateUser() {
			try {
				await this.user.post(process.env.BASE_URL+'/auth/user', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],

                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                }).then(response => {
                    this.$toast.success('Your profile updated successfully!');
                });
                
                await this.$auth.fetchUser();
			} catch (err) {
				console.log(err)
			}
		},

        onAvatarChange(e) {
            const file = e.target.files[0]
            // Do some client side validation...
            this.user.avatar = file
        },
	},

	created(){
        this.setPageName();
    },

    mounted(){
        this.getUser();
    }
}
</script>

<style>

</style>