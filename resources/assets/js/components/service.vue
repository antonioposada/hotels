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
                <th width="50px">&nbsp;</th>
            </tr>
            </thead>
            <transition-group tag="tbody" leave-active-class="bounceOut">
                <tr v-for="service in services" :key="service.id" is="service-row" :service="service"
                    @update-service="updateService"
                    v-on:delete-service="deleteService"></tr>
            </transition-group>
            <tfoot>
            <tr>
                <td>
                    <input type="text" v-model="new_service.name" class="form-control">
                    <ul v-if="errors && errors.length">
                        <li v-for="error in errors" class="text-danger">{{ error }}</li>
                    </ul>
                </td>
                <td>
                    <a href="#" @click.prevent="createService()">
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
            new_service: {
                name: ''
            },
            services: [],
            errors: [],
            alert: {
                message: '',
                display: false
            }
        }
    },
    mounted: function(){

        resource = this.$resource('api/services{/id}');
        // vue resource js
        resource.get().then(function(response) {
            // success callback
            this.services = response.data;
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
        createService: function () {
            this.errors = [];

            // vue resource js
            resource.save({},this.new_service).then(function(response) {
                // success callback
                this.services.push(response.data.service);
            }, function(response)  {
                this.errors = response.data.errors;
            });

            this.new_service = {name: ''};
        },
        deleteService: function (service) {
            resource.delete({id: service.id}).then(function (response) {
                var index = this.services.indexOf(service);
                this.services.splice(index, 1);
            });
        },
        updateService: function (component) {
            resource.update({id: component.service.id}, component.draft).then(function (response) {
                utils.assign(component.service,response.data.service);

                component.editing = false;
            }, function (response) {
                component.errors = response.data.errors;
            });
        }
    }
}
</script>