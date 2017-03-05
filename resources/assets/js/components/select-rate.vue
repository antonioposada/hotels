<template>
    <select v-model="offer.rate_id" class="form-control">
        <option value="">- Select rate -</option>
        <option v-for="rate in rates" :value="rate.id">
            {{ rate.name }}
        </option>
    </select>
</template>
<script>
export default {
    template: "#select_rate_tpl",
    props: ['rates', 'offer']
}
</script>