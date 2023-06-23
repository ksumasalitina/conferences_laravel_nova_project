<template>
    <v-app>
        <v-main>
            <v-container>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <form ref="form"  @submit.prevent="logIn">
                                    <v-text-field
                                        v-model="login.email"
                                        name="email"
                                        label="Email"
                                        type="text"
                                        placeholder="Email"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="login.password"
                                        name="password"
                                        label="Password"
                                        type="password"
                                        placeholder="password"
                                        required
                                    ></v-text-field>
                                    <v-btn type="submit" class="mt-4" color="primary" value="log in">Login</v-btn>
                                </form>
                            </v-card-text>
                        </v-card>

                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import auth from "../../services/auth/auth";
export default {
    name: "LoginComponent",
    data(){
        return {
            login: {
                email: '',
                password: ''
            }
        }
    },
    mounted() {
    },
    methods:{
        logIn() {
            auth.login(this.login)
                .then((res)=>{ if(res) this.$router.push({name: 'home'});})
                .then((res)=>{if(res) this.$router.go(0);});
        }
    }
}
</script>

<style scoped>

</style>
