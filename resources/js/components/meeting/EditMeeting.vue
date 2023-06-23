<template>
    <div>
        <h2 align="center">Edit meeting</h2>
        <v-layout justify-center>
            <v-flex xs4>
                <v-form @submit.prevent="update">
                    <v-text-field label="Title" v-model="meeting.title" required></v-text-field>
                    <v-select :items="list" item-text="name" item-value="id"
                              label="Select category" v-model="meeting.category"></v-select>
                    <p>Choose date:</p>
<!--                    <v-date-picker v-model="meeting.date"></v-date-picker><hr>-->
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
import moment from 'moment';
export default {
    name: "EditMeeting",
    data(){
        return{
            center: {lat:0, lng:0},
        }
    },

    computed: mapState({
        countries: state => state.meeting.countries,
        meeting: state => state.meeting.meetings,
        list: state => state.category.list
    }),

    mounted(){
        this.getCountries();
        this.fetchCategoryList();
        this.getMeeting(this.$route.params.id)
            .then(this.getCoordinates)
            .then(this.changeDateFormat);
    },

    methods:{
        ...mapActions('meeting',['getCountries','getMeeting','updateMeeting']),
        ...mapActions('category',['fetchCategoryList']),
        update(){
           this.updateMeeting(this.meeting)
                .then((res)=>{this.$router.push({name: 'home'});});
        },

        getCoordinates(){
            this.center.lat = parseFloat(this.meeting.latitude);
            this.center.lng = parseFloat(this.meeting.longitude);
        },

        updateCoordinates(position){
            this.center = {
                lat: position.latLng.lat(),
                lng: position.latLng.lng(),
            };
            this.meeting.latitude = position.latLng.lat();
            this.meeting.longitude = position.latLng.lng();
        },
        changeDateFormat(){
            this.meeting.date = new Date(this.meeting.date*1000).toISOString().substr(0,10);
        }
}
}
</script>

<style scoped>

</style>
