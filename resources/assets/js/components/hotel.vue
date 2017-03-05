<template>
    <div>

        <transition name="fade">
            <div class="alert_container">
                <p v-show="alert.display"
                   class="alert alert-danger"
                   id="error_message">{{ alert.message }}</p>
            </div>
        </transition>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Address</th>
                <th width="100px">&nbsp;</th>
            </tr>
            </thead>
            <transition-group tag="tbody" leave-active-class="bounceOut">
                <tr v-for="hotel in hotels" :key="hotel.id" is="hotel-row" :hotel="hotel"
                    @update-hotel="updateHotel"
                    v-on:delete-hotel="deleteHotel"></tr>
            </transition-group>
            <tfoot>
            <tr>
                <td>
                    <input type="text" v-model="new_hotel.name" class="form-control">
                    <ul v-if="errors && errors.length">
                        <li v-for="error in errors" class="text-danger">{{ error }}</li>
                    </ul>
                </td>
                <td>
                    <input type="text" v-model="new_hotel.category" class="form-control">
                </td>
                <td>
                    <input type="text" v-model="new_hotel.address" class="form-control">
                </td>
                <td>
                    <a href="#" @click.prevent="createHotel()">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
</template>


<script type="text/Javascript">
var Vue = require('vue');

Vue.use(require('vue-resource'));

var utils = require('../utils');

var resource;
var errors;

export default {
    data: function(){
       return {
            new_hotel: {
                name: '',
                category: '',
                address: ''
            },
            hotels: [],
            errors: [],
            alert: {
                message: '',
                display: false
            }
        }
    },
    mounted: function(){

        resource = this.$resource('api/hotels{/id}');
        // vue resource js
        resource.get().then(function(response) {
            // success callback
            this.hotels = response.data;
        });

        Vue.http.interceptors.push(function (request, next) {
            var token = document.getElementById('csrf-token').getAttribute('content');
            request.headers.set('X-CSRF-TOKEN', token);
            next(function (response) {
            console.log(response);
                if (response.ok) {
                    return response;
                }

                this.alert.message = response.category[0];
                this.alert.display = true;
                setTimeout(function () {
                    this.alert.display = false;
                }.bind(this), 4000);
                return response;
            });
        });
    },
    methods: {
        createHotel: function () {
            this.errors = [];

            // vue resource js
            resource.save({},this.new_hotel).then(function(response) {
                // success callback
                this.hotels.push(response.data.hotel);
            }, function(response)  {
                this.errors = response.data.errors;
            });

            this.new_hotel = {name: '', category: '', address: ''};
        },
        deleteHotel: function (hotel) {
            resource.delete({id: hotel.id}).then(function (response) {
                var index = this.hotels.indexOf(hotel);
                this.hotels.splice(index, 1);
            });
        },
        updateHotel: function (component) {
            resource.update({id: component.hotel.id}, component.draft).then(function (response) {
                utils.assign(component.hotel,response.data.hotel);

                component.editing = false;
            }, function (response) {
                component.errors = response.data.errors;
            });
        }
    }
}
</script>