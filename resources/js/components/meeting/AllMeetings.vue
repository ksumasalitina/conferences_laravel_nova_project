<template>
    <div>
        <div>
            <h1 class="h-home">List of meetings</h1>
        </div>
        <v-dialog
            v-model="dialog"
            width="500"
        ><export-loading></export-loading></v-dialog>
        <v-dialog width="60%" v-model="flash_message"><flash-message></flash-message></v-dialog>
        <filters-list v-if="is_logged"></filters-list>
        <v-skeleton-loader
            class="mt-3"
            v-if="loader"
            type="table"
        ></v-skeleton-loader>
    <v-simple-table>
        <template v-slot:default>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="meeting in meetings" :key="meeting.id">
                <th scope="row" width="15%">{{meeting.id}}</th>
                <td>{{meeting.title}}</td>
                <td>{{dateFormat(meeting.date)}}</td>
                <td>
                    <div v-if="is_admin">
                        <v-btn :to="{name: 'details', params: {id: meeting.id}}" elevation="2">Details</v-btn>
                        <v-btn :to="{name: 'edit', params: {id: meeting.id}}" elevation="2" color="blue">Edit</v-btn>
                        <v-btn elevation="2" color="red" @click="deleteMeeting(meeting.id)">Delete</v-btn>
                    </div>

                    <div v-else-if="meeting.is_joined" class="f-inline">
                        <v-btn :to="{name: 'details', params: {id: meeting.id}}" elevation="2">Details</v-btn>
                        <v-btn elevation="2" @click="checkWhoCancel(meeting.id)" color="red">Cancel participation</v-btn>
                        <sharing-buttons></sharing-buttons>
                    </div>

                    <div v-else class="f-inline">
                        <v-btn :to="{name: 'details', params: {id: meeting.id}}" elevation="2">Details</v-btn>
                        <v-btn @click="checkWhoJoin(meeting.id)" color="yellow">Join</v-btn>
                    </div>
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
    <v-pagination v-if="!filters" v-model="page" :length="total_pages" @input="getAllMeetings(page)"></v-pagination>
        <v-pagination v-else v-model="page" :length="total_pages" @input="filter" circle></v-pagination>
    </div>
</template>

<script>
import {mapState, mapActions} from 'vuex';
import auth from "../../services/auth/auth";
import SharingButtons from "./SharingButtons";
import timeConverter from "../../timeConverter";
import FiltersList from "./FiltersList";
import ExportLoading from "../loader/ExportLoading";
import planService from "../../services/plan/planService";
import FlashMessage from "../subscription/FlashMessage";
export default {
    name: "AllMeetings",
    components: {FlashMessage, ExportLoading,SharingButtons,FiltersList},
    data(){
        return {
            is_admin: auth.user().role[0].name === 'admin',
            is_logged: auth.loggedIn(),
            page: 1,
            filters: null,
            dialog: false,
            export_complete: false,
            plan: [],
            flash_message: false
        }
    },
    computed: mapState({
        meetings: state => state.meeting.meetings,
        lecture_id: state => state.lecture.lecture_id,
        current_page: state => state.meeting.current_page,
        total_pages: state => state.meeting.total_pages,
        loader: state => state.meeting.skeleton_loader
    }),
    mounted() {
       this.getAllMeetings(1);
       planService.fetchCurrentPlan().then(res => {this.plan = res.data});

    },

    methods:{
        ...mapActions('meeting',['getAllMeetings','deleteMeeting','join','cancel','getMeetingsByFilter']),
        ...mapActions('lecture',['getMeetingUserLecture','deleteLecture']),
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

        dateFormat(date) {return timeConverter.convertDate(date);},

        filter() {
            this.filters['page'] = this.page;
            this.getMeetingsByFilter(this.filters);
        },
    }
}
</script>
