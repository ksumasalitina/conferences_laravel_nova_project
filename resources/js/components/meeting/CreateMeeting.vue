<template>
    <div>
        <h2 align="center">Create meeting</h2>
        <v-layout justify-center>
            <v-flex xs4>
                <v-form @submit.prevent="create">
                    <v-text-field label="Title" v-model="meeting.title" required></v-text-field>
                    <v-select :items="list" item-text="name" item-value="id"
                    label="Select category" v-model="meeting.category"></v-select>
                    <p>Choose date:</p>
                    <v-date-picker v-model="meeting.date"></v-date-picker><hr>
                    <p><em><b>Address:</b></em></p>
                    <v-select
                        v-model="meeting.country"
                        :items="countries"
                        item-text="name"
                        item-value="name"
                        label="Select country"
                        required
                    ></v-select>
                    <v-row justify="space-between">
                        <v-col><v-text-field label="Latitude" v-model="meeting.latitude" required></v-text-field></v-col>
                        <v-col><v-text-field label="Longitude" v-model="meeting.longitude" required></v-text-field></v-col>
                    </v-row>
                    <GmapMap
                        :center='center'
                        :zoom='12'
                        style='width:100%;  height: 400px;'
                    >
                        <GmapMarker
                            :position='center'
                            :draggable="true"
                            @dragend="updateCoordinates"
                        />
                    </GmapMap><hr>
                    <v-row>
                        <v-col><v-btn :to="{name:'home'}" color="secondary">Back</v-btn></v-col>
                        <v-col><v-btn color="yellow" type="submit">Save</v-btn></v-col>
                    </v-row>
                </v-form>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
import {mapState, mapActions} from "vuex";

export default {
    name: "CreateMeeting",
    data(){
        return {
            meeting: {
                title: "",
                date: "",
                category:"",
                country: "",
                latitude: "",
                longitude: ""
            },
            center: {lat:0, lng:0},
        }
    },

    computed: mapState({
        countries: state => state.meeting.countries,
        list: state => state.category.list
    }),

    mounted(){
        this.getCountries();
        this.geolocate();
        this.fetchCategoryList();
    },

    methods: {
        ...mapActions('meeting', ['getCountries','createMeeting']),
        ...mapActions('category',['fetchCategoryList']),
        create(){
            this.createMeeting(this.meeting)
                .then(response =>(this.$router.push({name: 'home'})))
        },

        geolocate(){
            navigator.geolocation.getCurrentPosition(position => {
                this.center = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
            });
        },

        updateCoordinates(position){
            this.center = {
                lat: position.latLng.lat(),
                lng: position.latLng.lng(),
            };
            this.meeting.latitude = position.latLng.lat();
            this.meeting.longitude = position.latLng.lng();
        }
    }
}
</script>

<style scoped>

</style>
