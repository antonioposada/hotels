<template>
    <select v-model="room.room_type_id" class="form-control">
        <option value="">- Select rate -</option>
        <option v-for="roomtype in roomtypes" :value="roomtype.id">
            {{ roomtype.name }}
        </option>
    </select>
</template>
<script>
export default {
    template: "#select_rate_tpl",
    props: ['roomtypes', 'room']
}
</script>