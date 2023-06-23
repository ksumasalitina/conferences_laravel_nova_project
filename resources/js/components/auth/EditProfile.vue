<template>
 <v-app>
     <v-main>
         <v-container>
             <v-layout align-center justify-center>
                 <v-flex xs12 sm8 md4>
                     <v-card class="elevation-12">
                         <v-toolbar dark color="primary">
                             <v-toolbar-title>Edit profile</v-toolbar-title>
                         </v-toolbar>
                         <v-card-text>
                             <form ref="form"  @submit.prevent="update">
                                 <v-text-field v-model="user.first_name" label="First name" required/>
                                 <v-text-field v-model="user.last_name" label="Last name" required/>
                                 <v-text-field v-model="user.email" label="Email" type="email" required/>
                                 <v-text-field v-model="user.password" label="New password" type="password"/>
                                 <v-text-field v-model="user.password_confirmation" label="Confirm new password" type="password"/>
                                 <v-text-field v-model="user.birthdate" label="Birth date" type="date" required/>
                                 <v-select
                                     v-model="user.country"
                                     :items="countries"
                                     item-text="name"
                                     item-value="name"
                                     label="Select country"
                                     required
                                 ></v-select>
                                 <v-text-field v-model="user.phone" label="Phone number" type="text" required/>
                                 <v-btn type="submit" class="mt-4" color="primary">Save</v-btn>
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
import meetingService from "../../services/meeting/meetingService";
import timeConverter from "../../timeConverter";
export default {
    name: "EditProfile",
    data() {
        return {
            user: auth.user(),
            countries:[]
        }
    },
    mounted() {
        meetingService.fetchCountries().then(res=>{this.countries = res.data});
        this.convert();
    },
    methods: {
        update() {
            auth.update(this.user);
            auth.logout();
            this.$router.push({name:'login'}).then((res)=>{this.$router.go(0);});
        },
        convert() {
            this.user.birthdate = timeConverter.convertInputDate(this.user.birthdate);
        }
    }
}
</script>

<style scoped>

</style>
