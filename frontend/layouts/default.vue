<template>
    <div class="cuckoos-style">
        <Header/>
        <nuxt />
        <Footer/>
    </div>
</template>

<script>
    import Header from '~/components/Header'
    import Footer from '~/components/Footer'
    export default {
        components: {
            Header,
            Footer
        },
        head() {
            return {
                script: [
                    { src: 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js' },
                    { src: 'https://code.jquery.com/jquery-3.3.1.min.js' },
                    { src: 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js' }
                ],
            }
        },
        methods: {
            loadSetting(){
                this.$axios.get(process.env.BASE_URL+'/setting').then(response => {
                    this.$store.commit('SET_SETTING', response.data[0]);
                    this.$store.commit('SET_CAMPAIGN', response.data[1]);
                });
            }
        },
        mounted(){
            this.loadSetting();
        }
    }
</script>

<style lang="scss">
    @import '../assets/scss/index.scss';
    @import '../static/sass/bootstrap.scss';

    .cuckoos-style {
        @import '../static/sass/ui';
        @import '../static/sass/responsive';
    }
</style>
