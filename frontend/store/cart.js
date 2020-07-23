export const state = () => ({
    cartProducts: [],
    coupon: {},
    points: 0,
    deductedPoints: {},
})

export const getters = {
    getCartProducts(state) {
        return state.cartProducts;
    },
    getCoupon(state){
        return state.coupon;
    },

    subTotalPrice(state){
        let items = state.cartProducts;
        let price = 0;

        if(items && items.length){
            items.forEach(item => {
                price += item.product.price * item.qty;
            });
        }

        return (price / 100).toFixed(2);
    },

    totalPrice(state, getters){
        let price = getters.subTotalPrice;

        if(Object.keys(state.deductedPoints).length){
            price = price - state.deductedPoints.money;
        }
        
        if(Object.keys(state.coupon).length){
            price = price - getters.discountAmount;

            return (price).toFixed(2);
        }else {
            return price;
        }
    },

    discountAmount(state, getters){
        let coupon = state.coupon;

        if(Object.keys(coupon).length){
            if(coupon.type == 1) {
                let totalPrice = getters.subTotalPrice;
                let amount = (totalPrice / 100) * coupon.amount;

                return (amount).toFixed(2);
            }else {
                return (coupon.amount).toFixed(2);
            }
        }
    },
    getDeductedPoints(state){
        return state.deductedPoints;
    }
}

export const mutations = {
    SET_CART_PRODUCTS(state, payload){
        state.cartProducts = payload;
    },

    ADD_TO_CART (state, payload) {
        let items = state.cartProducts;

        if(items){
            items.push(payload);
        }else {
            state.cartProducts = [payload];
        }
    },

    REMOVE_PRODUCT(state, payload){
        let items = state.cartProducts;
        if(items){
            let product = items.find(product => {
                return product.id == payload.id;
            });

            if(product){
                let index = items.indexOf(product);
                items = items.splice(index, 1);
            }
        }
    },

    SET_COUPON(state, payload){
        state.coupon = payload;
    },

    SET_DEDUCTED_POINTS(state, payload){
        state.deductedPoints = payload;
    }
}

export const actions = {
    addToCart({ commit }, { product, quantity }){
        let cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];

        let addToCart = function() {
            let item = {
                id: Date.now(),
                qty: quantity,
                product: product,
            }

            cartProducts.push(item);
            localStorage.setItem('cartProducts', JSON.stringify(cartProducts));

            commit('ADD_TO_CART', item); 
        }

        if(cartProducts){
            let cartItem = cartProducts.find(item => {
                return item.product.id == product.id;
            });

            if(cartItem){
                let index = cartProducts.indexOf(cartItem);

                let cartProduct = cartItem;
                cartProduct.qty += 1;
                
                cartProducts[index] = cartProduct;
        
                localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
                commit('SET_CART_PRODUCTS', cartProducts);                
            }else {
                addToCart();
            }
        }else {
            addToCart();
        }
    },
    
    updateCartItem({commit}, {product, quantity}){
        let cartProducts = JSON.parse(localStorage.getItem('cartProducts'))

        if(cartProducts){
            let item = cartProducts.find(item => {
                return item.id == product.id;
            });

            if(item){
                let index = cartProducts.indexOf(item);

                let cartItem = item;
                cartItem.qty = quantity;
                
                cartProducts[index] = cartItem;
            }
        }
        
        localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
        commit('SET_CART_PRODUCTS', cartProducts);
    },

    removeCartItem({commit}, product){
        let cartProducts = JSON.parse(localStorage.getItem('cartProducts'))

        if(cartProducts){
            let item = cartProducts.find(item => {
                return item.id == product.id;
            });

            if(item){
                let index = cartProducts.indexOf(item);
                cartProducts.splice(index, 1);
            }
        }
        
        localStorage.setItem('cartProducts', JSON.stringify(cartProducts));

        commit('REMOVE_PRODUCT', product);
    },
}