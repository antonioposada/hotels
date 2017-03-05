<template>
    <tr class="animated">
        <template v-if="! editing">
            <td>{{ service.name }}</td>
            <td>
                <a href="#" @click.prevent="edit()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a href="#" @click.prevent="remove()">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </template>
        <template v-else>
            <td>
                <input type="text" v-model="draft.name" class="form-control">
                <ul v-if="errors.length" class="text-danger">
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
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
    props: ['service'],
    data: function() {
        return {
            editing: false,
            errors: [],
            draft: {}
        };
    },
   /* computed: {
        category_name: function () {
            var category = utils.findById(this.services, this.service.category_id);
            return category != null ? category.name : '';
        }
    },*/
    methods: {
        edit: function () {
            this.errors = [];
            this.draft = JSON.parse(JSON.stringify(this.service));
            this.editing = true;
        },
        cancel: function () {
            this.editing = false;
        },
        update: function () {
            this.errors = [];
            this.$emit('update-service', this);
        },
        remove: function () {
            this.$emit('delete-service', this.service);
        }
    }
}
</script>