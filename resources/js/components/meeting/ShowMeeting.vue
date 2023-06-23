<template>
    <v-layout justify-center>
        <v-dialog
            v-model="dialog"
            width="500"
        ><export-loading></export-loading></v-dialog>
        <v-dialog width="60%" v-model="flash_message"><flash-message></flash-message></v-dialog>
    <v-card elevation="2" width="40%">
        <v-card-title>
            <p class="text-h4">{{meeting.title}}</p>
        </v-card-title>
        <v-card-subtitle>
            <p>{{category}}</p>
            <hr width="90%">
        </v-card-subtitle>
        <v-card-text class="text--primary">
            <div>
                <b class="f-inline">Date: </b>
                <p class="f-inline">{{new Date(meeting.date)}}</p>
            </div>
            <div>
                <b class="f-inline">Country: </b>
                <p class="f-inline">{{meeting.country}}</p>
            </div><hr width="90%">
            <div>
                <b class="f-inline">Address: </b>
                <p class="f-inline" id="lat">{{meeting.latitude}}</p>
                <p class="f-inline" id="lng">{{meeting.longitude}}</p>
            </div>
            <GmapMap
                :center='center'
                :zoom='10'
                style='width:100%; height: 400px;'>
                <GmapMarker :position='center'/>
            </GmapMap>
            <hr width="90%">

            <v-row v-if="is_admin">
                <v-col>
                    <v-btn :to="{name: 'edit', params: {id: meeting.id}}" color="blue">Edit</v-btn>
                </v-col>
                <v-col>
                    <v-btn color="red" @click="destroy(meeting.id)">Delete</v-btn>
                </v-col>
                <v-col>
                    <v-btn color="yellow" @click="exportMembers($route.params.id); dialog=true">Export members</v-btn>
                </v-col>
            </v-row>

            <v-row v-else-if="meeting.is_joined">
                <v-col>
                    <v-btn color="red" @click="checkWhoCancel(meeting.id)">Cancel participation</v-btn>
                </v-col>
                <v-col><sharing-buttons></sharing-buttons></v-col>
            </v-row>

            <v-row v-else>
                <v-btn color="yellow" @click="checkWhoJoin(meeting.id)">Join</v-btn>
            </v-row>
            <v-row><v-btn :to="{name: 'show_meeting_lectures'}" color="blue">Lectures</v-btn></v-row>
        </v-card-text>
    </v-card>
    </v-layout>
</template>

<script>
import {mapActions, mapState} from 'vuex';
import auth from "../../services/auth/auth";
import SharingButtons from "./SharingButtons";
import ExportLoading from "../loader/ExportLoading";
import planService from "../../services/plan/planService";
import FlashMessage from "../subscription/FlashMessage";
export default {
    name: "ShowMeeting",
    components: {ExportLoading, SharingButtons, FlashMessage},
    data() {
        return {
            center: { lat: 0, lng: 0 },
            is_admin: auth.user().role[0].name === 'admin',
            dialog: false,
            plan: [],
            flash_message: false
        }
    },

    computed:mapState({
        meeting: state => state.meeting.meetings,
        lecture_id: state=> state.lecture.lecture_id,
        category: state => state.meeting.category
    }),

    mounted() {
        this.getMeeting(this.$route.params.id).then(this.getCoordinates);
        planService.fetchCurrentPlan().then(res => {this.plan = res.data});
    },

    methods: {
        ...mapActions('meeting', ['getMeeting','deleteMeeting','join','cancel','exportMembers']),
        ...mapActions('lecture', ['getMeetingUserLecture','deleteLecture']),

        destroy(id) {
            this.deleteMeeting(id).then(res=>{this.$router.push({name: 'home'})});
        },

        checkWhoJoin(id) {
            if(this.plan.joins < 1){
                this.flash_message = true;
                setTimeout(() => {
                    this.$router.push({name: 'plans'});
                },3000)
            } else {
                if(auth.user().role[0].name === 'announcer'){
                    this.$router.push({name: 'create_lecture', params:{id:id}});
                }
                else this.join(id);
            }
        },

        async checkWhoCancel(id) {
            if(auth.user().role[0].name === 'announcer'){
                await this.getMeetingUserLecture(id);
                await this.deleteLecture(this.lecture_id);
            }
            await this.cancel(id);
        },

        getCoordinates(){
            if(this.meeting.latitude!=null && this.meeting.longitude!=null){
                this.center.lat = parseFloat(this.meeting.latitude);
                this.center.lng = parseFloat(this.meeting.longitude);
            }
        }
    }
}
</script>

<style scoped>

</style>
