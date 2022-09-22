<script>
import axios from 'axios';

    export default {
        props: ['item'],
        methods: {
            updateCheck() {
                axios.put('http://localhost:8000/api/item/' + this.item.id, {
                    name: this.item.name,
                    completed: true,
                } )
                .then(response => {
                    if (response.status == 200) {
                        console.log('Done..');
                    }
                    console.log(response);
                } )
                .catch(error => {
                    console.log(error);
                })
            },
            removeItem() {
                axios.delete('http://localhost:8000/api/item/' + this.item.id)
                .then(response => {
                    console.log(response);
                    this.$emit('itemDeleted');
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<template>
    <div class="item">
        <input v-if="!item.completed" type="checkbox" @change="updateCheck()" v-model="item.completed">
        <span :class="[item.completed ? 'completed' : '', 'item-text']">{{ item.name }}</span>
        <button @click="removeItem()">Remove Item</button>
    </div>
</template>

<style>
    .completed {
        text-decoration: line-through;
    }
</style>