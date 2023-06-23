<template>
    <v-app>
        <v-main>
            <v-container>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Register form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <form ref="form"  @submit.prevent="register">
                                    <v-text-field
                                        v-model="user.first_name"
                                        label="First name"
                                        type="text"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="user.last_name"
                                        label="Last name"
                                        type="text"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="user.email"
                                        label="Email"
                                        type="email"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="user.password"
                                        label="Password"
                                        type="password"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="user.password_confirmation"
                                        label="Confirm password"
                                        type="password"
                                        required
                                    ></v-text-field>

                                    <v-text-field
                                        v-model="user.birthdate"
                                        label="Birth date"
                                        type="date"
                                        required
                                    ></v-text-field>

                                    <v-select
                                        v-model="user.country"
                                        :items="countries"
                                        item-text="name"
                                        item-value="name"
                                        label="Select country"
                                        required
                                    ></v-select>

                                    <v-text-field
                                        v-model="user.phone"
                                        label="Phone number"
                                        type="text"
                                        required
                                    ></v-text-field>

                                    <v-radio-group v-model="user.role">
                                        <v-radio
                                            label="Listener"
                                            value="1"
                                        ></v-radio>
                                        <v-radio
                                            label="Announcer"
                                            value="2"
                                            color="red"
                                        ></v-radio>
                                    </v-radio-group>
                                    <v-btn type="submit" class="mt-4" color="primary" value="log in">Submit</v-btn>
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
    name: "RegisterComponent",
    data(){
        return {
            user:{
               first_name: '',
               last_name: '',
               email: '',
               password: '',
               password_confirmation: '',
               birthdate: '',
               country:'',
               phone: '',
               role: ''
            },
            countries:[]
        }
    },
    mounted() {
        this.getCountries();
    },
    methods: {
        getCountries() {
            this.axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });
        },
        register(){
            auth.register(this.user)
                .then((res)=>{this.$router.push({name: 'home'});})
                .then((res)=>{this.$router.go(0);});
        }
    }
}
</script>

<style scoped>

</style>
