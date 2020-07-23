require('dotenv').config()
export default {
  mode: 'universal',
  
  /*
   ** Headers of the page
   */
  head: {
    title: 'Multivendor eCommerce Platform' || process.env.npm_package_name,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '~/static/icon.png' },
      { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css' },
    ],
    script: [
      { src: '' }
    ]
  },
  /*
   ** Customize the progress-bar color
   */
  loading: {
    color: '#fff'
  },
  /*
   ** Global CSS
   */
  css: [],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    '~/plugins/vform.js',
    { src: '~/plugins/owl.js', ssr: false },
    { src: '~/plugins/notification.js', ssr: false },
    { src: '~/plugins/vue-slider.js', ssr: false }
  ],

  router: {
    // linkActiveClass: 'your-custom-active-link',
    linkExactActiveClass: 'active',
    // canReuse: false
  },
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [
    '@nuxtjs/dotenv',
  ],
  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://bootstrap-vue.js.org
    // 'bootstrap-vue/nuxt',
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    '@nuxtjs/pwa',
    // Doc: https://github.com/nuxt-community/dotenv-module
    '@nuxtjs/dotenv',
  ],

  auth: {
    strategies: {
      local: {
        endpoints: {
          login: {
            url: 'auth/login',
            method: 'post',
            propertyName: 'token'
          },
          logout: {
            url: 'auth/logout',
            method: 'post'
          },
          user: {
            url: 'auth/me',
            method: 'post',
            propertyName: false
          }
        },
        tokenRequired: true,
        tokenType: 'bearer'
        // autoFetchUser: true
      }
    }
  },
  /*
   ** Axios module configuration
   ** See https://axios.nuxtjs.org/options
   */
  axios: {
    // baseURL: 'https://admin.cuckoos.shop/api',
    // baseURL: 'https://localhost:8000/api',
    baseURL: 'http://127.0.0.1:8000/api',
  },
  /*
   ** Build configuration
   */
  build: {
    // analyze: true,
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  }
}
