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
                <th>Rates</th>
                <th>Percentage</th>
                <th width="50px">&nbsp;</th>
            </tr>
            </thead>
            <transition-group tag="tbody" leave-active-class="bounceOut">
                <tr v-for="offer in offers" :key="offer.id" is="offer-row" :offer="offer"
                    :rates="rates"
                    @update-offer="updateOffer"
                    v-on:delete-offer="deleteOffer"></tr>
            </transition-group>
            <tfoot>
            <tr>
                <td><select-rate :rates="rates" :offer="new_offer"></select-rate></td>
                <td>
                    <input type="text" v-model="new_offer.percentage" class="form-control">
                </td>
                <td>
                    <a href="#" @click.prevent="createOffer()">
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
            new_offer: {
                percentage: '',
                rate_id: ''
            },
            offers: [],
            rates: [],
            errors: [],
            alert: {
                message: '',
                display: false
            }
        }
    },
    mounted: function(){

        resource = this.$resource('api/offers{/id}');
        // vue resource js
        resource.get().then(function(response) {
            // success callback
            this.offers = response.data.offers;
            this.rates = response.data.rates;
        });

        Vue.http.interceptors.push(function (request, next) {
            var token = document.getElementById('csrf-token').getAttribute('content');
            request.headers.set('X-CSRF-TOKEN', token);
            next(function (response) {
                if (response.ok) {
                    return response;
                }
                this.alert.message = response.data.message;
                this.alert.display = true;
                setTimeout(function () {
                    this.alert.display = false;
                }.bind(this), 4000);
                return response;
            });
        });
    },
    methods: {
        createOffer: function () {
            this.errors = [];

            // vue resource js
            resource.save({},this.new_offer).then(function(response) {
                // success callback
                this.offers.push(response.data.offer);
            }, function(response)  {
                this.errors = response.data.errors;
            });

            this.new_offer = {name: '',rate_id: ''};
        },
        deleteOffer: function (offer) {
            resource.delete({id: offer.id}).then(function (response) {
                var index = this.offers.indexOf(offer);
                this.offers.splice(index, 1);
            });
        },
        updateOffer: function (component) {
            resource.update({id: component.offer.id}, component.draft).then(function (response) {
                utils.assign(component.offer,response.data.offer);

                component.editing = false;
            }, function (response) {
                component.errors = response.data.errors;
            });
        }
    }
}
</script>
