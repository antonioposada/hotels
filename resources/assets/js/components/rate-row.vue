<template>
    <tr class="animated">
        <template v-if="! editing">
            <td>{{ rate.name }}</td>
            <td>{{ rate.begin_date }}</td>
            <td>{{ rate.end_date }}</td>
            <td>{{ rate.price }}</td>
            <td>{{ rate.avalability }}</td>
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
                <input type="text" v-model="draft.begin_date" class="form-control">
            </td>
            <td>
                <input type="text" v-model="draft.end_date" class="form-control">
            </td>
            <td>
                <input type="text" v-model="draft.price" class="form-control">
            </td>
            <td>
                <input type="text" v-model="draft.avalability" class="form-control">
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
    props: ['rate'],
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
            this.draft = JSON.parse(JSON.stringify(this.rate));
            this.editing = true;
        },
        cancel: function () {
            this.editing = false;
        },
        update: function () {
            this.errors = [];
            this.$emit('update-rate', this);
        },
        remove: function () {
            this.$emit('delete-rate', this.rate);
        }
    }
}
</script>