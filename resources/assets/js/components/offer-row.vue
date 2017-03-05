<template>
    <tr class="animated">
        <template v-if="! editing">
            <td>{{ rate_name }}</td>
            <td>{{ offer.percentage }}</td>
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
                <select-rate :rates="rates" :offer="draft"></select-rate>
            </td>
            <td>
                <input type="text" v-model="draft.percentage" class="form-control">
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
    props: ['offer','rates'],
    data: function() {
        return {
            editing: false,
            errors: [],
            draft: {}
        };
    },
    computed: {
        rate_name: function () {
            var rate = utils.findById(this.rates, this.offer.rate_id);
            return rate != null ? rate.name : '';
        }
    },
    methods: {
        edit: function () {
            this.errors = [];
            this.draft = JSON.parse(JSON.stringify(this.offer));
            this.editing = true;
        },
        cancel: function () {
            this.editing = false;
        },
        update: function () {
            this.errors = [];
            this.$emit('update-offer', this);
        },
        remove: function () {
            this.$emit('delete-offer', this.offer);
        }
    }
}
</script>