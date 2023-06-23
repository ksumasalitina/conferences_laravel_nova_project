<template>
<div style="margin-right: 25px">
    <v-btn :to="{name:'favorites'}" text v-if="is_logged">
    <v-badge color="red" :content="count">
        <v-icon v-if="count === 0">
            mdi-heart-multiple-outline
        </v-icon>
        <v-icon v-else>
            mdi-heart-multiple
        </v-icon>
    </v-badge>
    </v-btn>
</div>
</template>

<script>
import auth from "../../services/auth/auth";
import {mapState, mapActions} from 'vuex';
export default {
    name: "FavoriteButton",
    data(){
        return {
            is_logged: auth.loggedIn()
        }
    },
    computed: mapState({
        count: state => state.favorite.count
    }),
    mounted (){
        this.fetchFavoritesCount();
    },
    methods: {
        ...mapActions('favorite', ['fetchFavoritesCount']),
    }
}
</script>

<style scoped>

</style>
