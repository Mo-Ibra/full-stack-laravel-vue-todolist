<script>
import axios from 'axios';

    export default {
        data: function() {
            return {
                item: {
                    name: "",
                    completed: false,
                }
            }
        },
        methods: {
            addItem() {
                if (this.item.name.split('').length < 1) {
                    return false;
                }

                axios.post('http://localhost:8000/api/item/store', {
                    name: this.item.name,
                    completed: this.item.completed,
                })
                .then( response => {
                    if (response.status === 201) {
                        this.item.name = "";
                        this.item.completed = false;
                        this.$emit('renderList');
                    } else if (response.status === 200) {
                        // Handle Errors.! (Validation)
                    }
                    console.log(response);
                })
                .catch( error => {
                    console.log(error);
                } )
            }
        }
    }
</script>

<template>
    <form @submit.prevent="addItem()">
        <input type="text" name="name" v-model="item.name">
        <button>Add Item</button>
    </form>
</template>