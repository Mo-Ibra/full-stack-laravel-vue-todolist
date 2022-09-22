<script>
    
    import ListItem from './ListItem.vue';

    export default {
        props: ['items'],
        components: {
            ListItem,
        }
    }

</script>

<template>
    <h1>Render Items:</h1>

    <div v-for="(item, index) in items" :key="index">
        <ListItem :item="item" class="item" v-on:itemDeleted="$emit('renderList')" />
    </div>

</template>

<style>
    
</style>