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
                <th>Num adults</th>
                <th>Num children</th>
                <th width="75px">&nbsp;</th>
            </tr>
            </thead>
            <transition-group tag="tbody" leave-active-class="bounceOut">
                <tr v-for="roomtype in roomtypes" :key="roomtype.id" is="room-type-row" :roomtype="roomtype"
                    @update-roomtype="updateRoomType"
                    v-on:delete-roomtype="deleteRoomType"></tr>
            </transition-group>
            <tfoot>
            <tr>
                <td>
                    <input type="text" v-model="new_roomtype.name" class="form-control">
                </td>
                <td>
                    <input type="text" v-model="new_roomtype.num_adults" class="form-control">
                    <ul v-if="errors && errors.length">
                        <li v-for="error in errors" class="text-danger">{{ error }}</li>
                    </ul>
                </td>
                <td>
                    <input type="text" v-model="new_roomtype.num_children" class="form-control">
                </td>
                <td>
                    <a href="#" @click.prevent="createRoomType()">
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
            new_roomtype: {
                name: '',
                num_adults: '',
                num_children :''
            },
            roomtypes: [],
            errors: [],
            alert: {
                message: '',
                display: false
            }
        }
    },
    mounted: function(){

        resource = this.$resource('api/roomtypes{/id}');
        // vue resource js
        resource.get().then(function(response) {
            // success callback
            this.roomtypes = response.data;
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
        createRoomType: function () {
            this.errors = [];

            // vue resource js
            resource.save({},this.new_roomtype).then(function(response) {
                // success callback
                this.roomtypes.push(response.data.roomtype);
            }, function(response)  {
                this.errors = response.data.errors;
            });

            this.new_roomtype = {
                name: '',
                num_adults: '',
                num_children :''
            };
        },
        deleteRoomType: function (roomtype) {
            resource.delete({id: roomtype.id}).then(function (response) {
                var index = this.roomtypes.indexOf(roomtype);
                this.roomtypes.splice(index, 1);
            });
        },
        updateRoomType: function (component) {
            resource.update({id: component.roomtype.id}, component.draft).then(function (response) {
                utils.assign(component.roomtype,response.data.roomtype);

                component.editing = false;
            }, function (response) {
                component.errors = response.data.errors;
            });
        }
    }
}
</script>