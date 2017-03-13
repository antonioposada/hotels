<template>
    <select v-model="room.hotel_id" class="form-control">
        <option value="">- Select hotel -</option>
        <option v-for="hotel in hotels" :value="hotel.id">
            {{ hotel.name }}
        </option>
    </select>
</template>
<script>
export default {
    template: "#select_rate_tpl",
    props: ['hotels', 'room']
}
</script>