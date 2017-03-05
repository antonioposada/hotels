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
                <th>Begin</th>
                <th>End</th>
                <th>Price</th>
                <th>Avalability</th>
                <th width="75px">&nbsp;</th>
            </tr>
            </thead>
            <transition-group tag="tbody" leave-active-class="bounceOut">
                <tr v-for="rate in rates" :key="rate.id" is="rate-row" :rate="rate"
                    @update-rate="updateRate"
                    @delete-rate="deleteRate"></tr>
            </transition-group>
            <tfoot>
            <tr>
                <td>
                    <input type="text" v-model="new_rate.name" class="form-control">
                </td>
                <td>
                    <input type="text" v-model="new_rate.begin_date" class="form-control">
                </td>
                <td>
                    <input type="text" v-model="new_rate.end_date" class="form-control">
                </td>
                <td>
                    <input type="text" v-model="new_rate.price" class="form-control">
                </td>
                <td>
                    <input type="text" v-model="new_rate.avalability" class="form-control">
                </td>
                <td>
                    <a href="#" @click.prevent="createRate()">
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

export default {
    data: function(){
       return {
            new_rate: {
                name: '',
                begin_date: '',
                end_date :'',
                price: '',
                avalability: ''
            },
            rates: [],
            errors: [],
            alert: {
                message: '',
                display: false
            }
        }
    },
    mounted: function(){

        resource = this.$resource('api/rates{/id}');
        // vue resource js
        resource.get().then(function(response) {
            // success callback
            this.rates = response.data;
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
        createRate: function () {
            this.errors = [];

            // vue resource js
            resource.save({},this.new_rate).then(function(response) {
                // success callback
                this.rates.push(response.data.rate);
            }, function(response)  {
                this.errors = response.data.errors;
            });

            this.new_rate = {
                name: '',
                begin_date: '',
                end_date :'',
                price: '',
                avalability: ''
            };
        },
        deleteRate: function (rate) {
            resource.delete({id: rate.id}).then(function (response) {
                var index = this.rates.indexOf(rate);
                this.rates.splice(index, 1);
            });
        },
        updateRate: function (component) {
            resource.update({id: component.rate.id}, component.draft).then(function (response) {
                utils.assign(component.rate,response.data.rate);

                component.editing = false;
            }, function (response) {
                component.errors = response.data.errors;
            });
        }
    }
}
</script>
