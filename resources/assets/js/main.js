var Vue = require('vue');

Vue.component('hotel-row', require('./components/hotel-row.vue'));

var AppHotel = require('./components/hotel.vue');

var app = new Vue({
    el: '#main',
    components: {
        apphotel: AppHotel
    }
});
