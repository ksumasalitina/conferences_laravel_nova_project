<template>
<div>
    <v-btn color="secondary" @click="showForm=!showForm">Add category</v-btn>
    <v-card width="30%" v-show="showForm">
        <v-card-text>
            <v-form @submit.prevent="addCat">
                <v-select label="Root" :items="list"  item-text="name" item-value="id" v-model="newCategory.parent_id"></v-select>
                <v-text-field label="Name" v-model="newCategory.name"></v-text-field>
                <v-btn type="submit">Send</v-btn>
            </v-form>
        </v-card-text>
    </v-card>
    <v-btn v-show="selected.id.length > 0" @click="deleteCat" color="red">Delete</v-btn>
    <v-treeview selectable :items="categories" selection-type="independent" v-model="selected.id"></v-treeview>

</div>
</template>

<script>
import {mapState, mapActions} from 'vuex';
export default {
    name: "ShowCategories",
    data() {
        return {
            selected: {
                id: []
            },
            newCategory: {
                name:'',
                parent_id:null
            },
            showForm:false
        }
    },
    computed: mapState({
        categories: state => state.category.categories,
        list: state => state.category.list
    }),
    mounted() {
        this.fetchCategories();
        this.fetchCategoryList();
    },
    methods: {
        ...mapActions('category',['fetchCategories','deleteCategory','fetchCategoryList','addCategory']),
        deleteCat() {
            this.deleteCategory(this.selected);
            this.fetchCategories();
            this.fetchCategoryList();
        },

        addCat() {
            this.addCategory(this.newCategory);
            this.fetchCategories();
            this.fetchCategoryList();
        }
    },
}
</script>

<style scoped>

</style>
