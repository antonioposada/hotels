<template>
    <tr class="animated">
        <template v-if="! editing">
            <td>{{ room.name }}</td>
            <td>{{ room_type_name }}</td>
            <td>{{ hotel_name }}</td>
            <td>
                <a href="#" @click.prevent="edit()">
                    <span class="glyphicon glyphicon-pencil" title="Edit" aria-hidden="true"></span>
                </a>
                <a href="#" @click.prevent="config()">
                    <span class="glyphicon glyphicon-eur" title="Rates" aria-hidden="true"></span>
                </a>
                <a href="#" @click.prevent="remove()">
                    <span class="glyphicon glyphicon-trash" title="Delete" aria-hidden="true"></span>
                </a>
            </td>
        </template>
        <template v-else>
            <td>
                <input type="text" v-model="draft.name" class="form-control">
            </td>
            <td>
                <select-room-type :roomtypes="roomtypes" :room="draft"></select-room-type>
            </td>
            <td>
                <select-hotel :hotels="hotels" :room="draft"></select-hotel>
            </td>
            <td>
                <a href="#" @click.prevent="update()">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </a>
                <a href="#" @click.prevent="cancel()">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
            </td>
        </template>
    </tr>
</template>

<script>
var utils = require('./../utils');

export default {
    props: ['room','hotels','roomtypes'],
    data: function() {
        return {
            editing: false,
            errors: [],
            draft: {}
        };
    },
    computed: {
        hotel_name: function () {
            var hotel = utils.findById(this.hotels, this.room.hotel_id);
            return hotel != null ? hotel.name : 'h';
        },
        room_type_name: function () {
            var roomtype = utils.findById(this.roomtypes, this.room.room_type_id);
            return roomtype != null ? roomtype.name : 'r';
        }
    },
    methods: {
        edit: function () {
            this.errors = [];
            this.draft = JSON.parse(JSON.stringify(this.room));
            this.editing = true;
        },
        cancel: function () {
            this.editing = false;
        },
        update: function () {
            this.errors = [];
            this.$emit('update-room', this);
        },
        remove: function () {
            this.$emit('delete-room', this.room);
        },
        config: function (){
            location.href = 'roomrates/'+this.room.id;
        }
    }
}
</script>