<template>
    <tr class="animated">
        <template v-if="! editing">
            <td>{{ hotel.name }}</td>
            <td>{{ hotel.category }}</td>
            <td>{{ hotel.address }}</td>
            <td>
                <a href="#" @click.prevent="edit()">
                    <span class="glyphicon glyphicon-pencil" title="Edit" aria-hidden="true"></span>
                </a>
                <a href="#" @click.prevent="config()">
                    <span class="glyphicon glyphicon-home" title="Services" aria-hidden="true"></span>
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
                <input type="text" v-model="draft.category" class="form-control">
            </td>
            <td>
                <input type="text" v-model="draft.address" class="form-control">
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
    props: ['hotel'],
    data: function() {
        return {
            editing: false,
            errors: [],
            draft: {}
        };
    },
    methods: {
        edit: function () {
            this.errors = [];
            this.draft = JSON.parse(JSON.stringify(this.hotel));
            this.editing = true;
        },
        cancel: function () {
            this.editing = false;
        },
        update: function () {
            this.errors = [];
            this.$emit('update-hotel', this);
        },
        remove: function () {
            this.$emit('delete-hotel', this.hotel);
        },
        config: function (){
            location.href = 'hotelservices/'+this.hotel.id;
        }

    }
}
</script>