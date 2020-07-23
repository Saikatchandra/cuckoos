export const state = () => ({
    name: '',
    setting: {},
    campaign: {},
    wallet: {},
    postBoxLayout: true,
    categories: [],
    query: '',
})

export const getters = {
    getPageName(state) {
        return state.name
    },

    updateImageURL(){
        return function(image){
            return process.env.APP_URL + image;
        }
    },

    isAuthenticated(state) {
        return state.auth.loggedIn
    },

    loggedInUser(state) {
        return state.auth.user
    },

    getSetting(state){
        return state.setting;
    },

    getCampaign(state){
        return state.campaign;
    },
    
    getWallet(state){
        return state.wallet;
    },
    getPostLayout(state){
        return state.postBoxLayout;
    },
    getCategories(state){
        return state.categories;
    },
    getQuery(state){
        return state.query;
    }
}

export const mutations = {
    SET_NAME(state, payload) {
        state.name = payload;
    },

    SET_SETTING(state, payload){
        state.setting = payload;
    },

    SET_CAMPAIGN(state, payload){
        state.campaign = payload;
    },

    SET_WALLET(state, payload){
        state.wallet = payload;
    },
    SET_POST_LAYOUT(state, payload){
        localStorage.setItem('layout', JSON.stringify(payload));
        state.postBoxLayout = payload;
    },
    SET_CATEGORIES(state, payload){
        state.categories = payload;
    },
    SET_QUERY(state, payload){
        state.query = payload;
    }
}