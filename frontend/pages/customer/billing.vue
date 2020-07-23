<template>
    <div>
        <article class="card">
            <header class="card-header"> My Billing Information</header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-muted text-center">My Cards</h5>
                        <table class="table">
                            <tr>
                                <td>
                                    Mastercard<br>
                                    Checking ****5896
                                </td>
                                <td width="25%">
                                    <button class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    VISA<br>
                                    Checking ****5896
                                </td>
                                <td width="25%">
                                    <button class="btn btn-primary btn-sm"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i
                                            class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mastero<br>
                                    Checking ****5896
                                </td>
                                <td width="25%">
                                    <button class="btn btn-primary btn-sm"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i
                                            class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted text-center">Add New Cards</h5>
                        <form>
                            <div class="form-group">
                                <label>Card Holder Name</label>
                                <input type="text" class="form-control" name="" placeholder="Ex: Jhon Due">
                            </div>
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" name=""
                                    placeholder="Ex: 5647-8547-4578-8759">
                            </div>
                            <div class="form-group">
                                <label>Expire Date</label>
                                <input type="text" class="form-control" name="" placeholder="Ex: 09/21">
                            </div>
                            <div class="form-group">
                                <label>Secuirty Number</label>
                                <input type="text" class="form-control" name="" placeholder="Ex: 268">
                            </div>
                            <button class="btn btn-primary float-right">Add Card</button>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</template>

<script>
export default {
    scrollToTop: true,
    data() {
        return {
            name: 'Billing Information'
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