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
                <th>Room Type</th>
                <th>Hotel</th>
                <th width="100px">&nbsp;</th>
            </tr>
            </thead>
            <transition-group tag="tbody" leave-active-class="bounceOut">
                <tr v-for="room in rooms" :key="room.id" is="room-row" :room="room"
                    :roomtypes="roomtypes"
                    :hotels="hotels"
                    @update-room="updateRoom"
                    v-on:delete-room="deleteRoom"></tr>
            </transition-group>
            <tfoot>
            <tr>
                <td>
                    <input type="text" v-model="new_room.name" class="form-control">
                </td>
                <td><select-room-type :roomtypes="roomtypes" :room="new_room"></select-room-type></td>
                <td><select-hotel :hotels="hotels" :room="new_room"></select-hotel></td>
                <td>
                    <a href="#" @click.prevent="createRoom()">
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
            new_room: {
                name: '',
                hotel_id: '',
                room_type_id: ''
            },
            rooms: [],
            hotels: [],
            roomtypes: [],
            errors: [],
            alert: {
                message: '',
                display: false
            }
        }
    },
    mounted: function(){

        resource = this.$resource('api/rooms{/id}');
        // vue resource js
        resource.get().then(function(response) {
            // success callback
            this.rooms = response.data.rooms;
            this.hotels = response.data.hotels;
            this.roomtypes = response.data.roomtypes;
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
        createRoom: function () {
            this.errors = [];

            // vue resource js
            resource.save({},this.new_room).then(function(response) {
                // success callback
                this.rooms.push(response.data.room);
            }, function(response)  {
                this.errors = response.data.errors;
            });

            this.new_room = {name: '',hotel_id: '',room_type_id: ''};
        },
        deleteRoom: function (room) {
            resource.delete({id: room.id}).then(function (response) {
                var index = this.rooms.indexOf(room);
                this.rooms.splice(index, 1);
            });
        },
        updateRoom: function (component) {
            resource.update({id: component.room.id}, component.draft).then(function (response) {
                utils.assign(component.room,response.data.room);

                component.editing = false;
            }, function (response) {
                component.errors = response.data.errors;
            });
        }
    }
}
</script>
