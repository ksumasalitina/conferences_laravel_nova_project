<template>
    <v-app>
        <v-app-bar app class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Meetings List</router-link>
                    <router-link to= "/create" class="nav-item nav-link" v-if="is_admin">Create Meeting</router-link>
                    <router-link to="/categories" class="nav-item nav-link" v-if="is_admin">Categories</router-link>
                    <router-link to="/zoom" class="nav-item nav-link" v-if="is_admin">Zoom</router-link>
                </div>
                <div style="margin-left: auto">
                    <v-btn :to="{name:'search'}" text><v-icon>mdi-magnify</v-icon></v-btn>
                    <favorite-button class="f-inline"></favorite-button>
                    <login-logout-buttons class="f-inline"></login-logout-buttons>
                </div>
            </div>
        </v-app-bar>
        <v-main>
            <v-container fluid>
                <router-view :key="$route.path"> </router-view>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
import LoginLogoutButtons from "./components/auth/LoginLogoutButtons";
import FavoriteButton from "./components/favorite/FavoriteButton";
import auth from "./services/auth/auth";
export default{
    components: {FavoriteButton, LoginLogoutButtons},
    data(){
        return{
            is_admin: auth.user().role[0].name === 'admin'
        }
    }
}
</script>
