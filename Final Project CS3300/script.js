class CartManager{
    constructor() {
        this.cart = JSON.parse(localStorage.getItem('cart')) || [];
        this.cartCountElement = document.querySelector('.cart-count');
        this.cartTotalElement = documet.querySelector('.cart-total');
        this.cartItemsContainer = documet.querySelector('.cart-item');
        this.initEventListeners();
        this.updateCartDisplay();
    }
    initEventListeners() {
        
    }

    }
