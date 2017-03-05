
var Vue = require('vue');

var utils = require('./utils');


Vue.filter('rate', function (id) {
    var rate = utils.findById(this.rates, id);

    return rate != null ? rate.name : '';
});


Vue.filter('hotel', function (id) {
    var hotel = utils.findById(this.hotels, id);

    return hotel != null ? hotel.name : '';
});


Vue.filter('roomtype', function (id) {
    var roomtype = utils.findById(this.roomtypes, id);

    return roomtype != null ? roomtype.name : '';
});

Vue.component('select-rate', require('./components/select-rate.vue'));
Vue.component('select-hotel', require('./components/select-hotel.vue'));
Vue.component('select-room-type', require('./components/select-room-type.vue'));

Vue.component('hotel-row', require('./components/hotel-row.vue'));
Vue.component('service-row', require('./components/service-row.vue'));
Vue.component('offer-row', require('./components/offer-row.vue'));
Vue.component('room-type-row', require('./components/room-type-row.vue'));
Vue.component('rate-row', require('./components/rate-row.vue'));
Vue.component('room-row', require('./components/room-row.vue'));


var App = require('./components/service.vue');
var AppHotel = require('./components/hotel.vue');
var AppOffer = require('./components/offer.vue');
var AppRoomType = require('./components/room-type.vue');
var AppRate = require('./components/rate.vue');
var AppRoom = require('./components/room.vue');

var vm = new Vue({
    el: '#main',
    components: {
        app: App,
        apphotel: AppHotel,
        appoffer: AppOffer,
        approomtype: AppRoomType,
        apprate: AppRate,
        approom: AppRoom
    }
});
