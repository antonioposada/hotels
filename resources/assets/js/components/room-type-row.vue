<template>
    <tr class="animated">
        <template v-if="! editing">
            <td>{{ roomtype.name }}</td>
            <td>{{ roomtype.num_adults }}</td>
            <td>{{ roomtype.num_children }}</td>
            <td>
                <a href="#" @click.prevent="edit()">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="#" @click.prevent="remove()">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </template>
        <template v-else>
            <td>
                <input type="text" v-model="draft.name" class="form-control">
            </td>
            <td>
                <input type="text" v-model="draft.num_adults" class="form-control">
            </td>
            <td>
                <input type="text" v-model="draft.num_children" class="form-control">
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
    props: ['roomtype'],
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
            this.draft = JSON.parse(JSON.stringify(this.roomtype));
            this.editing = true;
        },
        cancel: function () {
            this.editing = false;
        },
        update: function () {
            this.errors = [];
            this.$emit('update-roomtype', this);
        },
        remove: function () {
            this.$emit('delete-roomtype', this.roomtype);
        }
    }
}
</script>