<template>
<div>
    <v-menu offset-y>
        <template v-slot:activator="{on, attrs}">
            <v-btn color="secondary"  v-bind="attrs" v-on="on">Profile</v-btn>
        </template>
        <v-list v-if="!loggedIn">
            <v-list-item><v-btn to="/register" color="red" text>Register</v-btn></v-list-item>
            <v-list-item><v-btn to="/login" color="red" text>Login</v-btn></v-list-item>
        </v-list>
        <v-list v-else>
            <subscription-button></subscription-button>
            <v-list-item><v-btn :to="{name:'edit_profile', params:{id:user}}" text color="blue">Edit Profile</v-btn></v-list-item>
            <v-list-item><v-btn @click="logout" text color="blue">Logout</v-btn></v-list-item>
        </v-list>
    </v-menu>
</div>
</template>

<script>
import auth from "../../services/auth/auth";
import SubscriptionButton from "../subscription/SubscriptionButton";
export default {
    name: "LoginLogoutButtons",
    components: {SubscriptionButton},
    data(){
        return {
            loggedIn:null,
            user: auth.user().id
        }
    },
    mounted() {
        this.loggedIn = auth.loggedIn();
    },
    methods: {
        logout(){
            auth.logout();
            this.loggedIn = null;
        },
    },
}
</script>

<style scoped>

</style>
