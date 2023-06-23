<template>
<v-layout align-center justify-center>
    <v-simple-table>
        <template v-slot:default>
            <thead>
                <tr>
                    <th>Theme</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="favorite in favorites" :key="favorite.id">
                    <th>{{favorite.theme}}</th>
                    <th>{{favorite.description.slice(0,100)}}</th>
                    <th>
                        <v-btn :to="{name:'show_lecture',params:{id:favorite.id}}" color="blue" class="f-inline">Details</v-btn>
                        <v-btn @click="deleteFavorite(favorite.id)" color="red" class="f-inline">Delete</v-btn>
                    </th>
                </tr>
            </tbody>
        </template>
    </v-simple-table>
</v-layout>
</template>

<script>
import {mapState, mapActions} from "vuex";

export default {
    name: "ShawFavorites",
    computed:mapState({
        favorites: state => state.favorite.favorites
    }),
    mounted() {
        this.fetchFavorites();
    },
    methods: {
        ...mapActions('favorite',['fetchFavorites','deleteFavorite']),
    }
}
</script>

<style scoped>

</style>
