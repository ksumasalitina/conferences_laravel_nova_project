<template>
    <div>
    <v-layout justify-center>
        <v-card width="40%">
            <v-card-title class="text-h4">{{lecture.theme}}</v-card-title>
            <v-card-subtitle>{{category}}</v-card-subtitle>
            <hr width="90%" class="marg-auto">
            <v-card-text class="text--primary">{{lecture.start}} - {{lecture.end}}</v-card-text>
            <hr width="90%" class="marg-auto">
            <v-card-text class="text--primary">{{lecture.description}}</v-card-text><hr width="90%" class="marg-auto">
            <v-card-text v-if="lecture.is_joined">
                <vac :end-time="new Date(lecture.start_time).getTime() - 600000" v-if="lecture.user_id === user">
                    <span slot="process" slot-scope="{ timeObj }">
                        {{ `Time left: ${timeObj.d} days ${timeObj.h}:${timeObj.m}:${timeObj.s}`}}
                    </span>
                    <span slot="finish"><a :href="lecture.zoom_link" target="_blank">{{lecture.zoom_link}}</a></span>
                </vac>

                <vac :end-time="new Date(lecture.start_time).getTime()" v-else>
                    <span slot="process" slot-scope="{ timeObj }">
                        {{ `Time left: ${timeObj.d} days ${timeObj.h}:${timeObj.m}:${timeObj.s}`}}
                    </span>
                    <span slot="finish"><a :href="lecture.zoom_link" target="_blank">{{lecture.zoom_link}}</a></span>
                </vac>
            </v-card-text>
            <v-card-actions v-if="lecture.user_id === user">
                <v-btn color="blue" :to="{name: 'edit_lecture'}">Edit</v-btn>
                <v-btn color="red" @click="cancelParticipation">Cancel participation</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn color="blue" text @click="downloadPresentation(lecture.presentation)">Download presentation</v-btn>
            </v-card-actions>
        </v-card>
    </v-layout>
        <show-comments></show-comments>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import auth from "../../services/auth/auth";

export default {
    name: "ShowLecture",
    data() {
        return {
            user: auth.user().id,
            endAt:  (new Date).getTime()+5000
        }
    },
    components: {
        ShowComments: () => import('./ShowComments.vue')
    },
    computed: mapState({
        lecture: state => state.lecture.lectures,
        category: state => state.lecture.category
    }),
    mounted(){
        this.getLecture(this.$route.params.id);
    },
    methods: {
        ...mapActions('meeting', ['cancel']),
        ...mapActions('lecture',['getLecture','deleteLecture','downloadPresentation']),
        cancelParticipation() {
            this.deleteLecture(this.lecture.id);
            this.cancel(this.lecture.meeting_id);
            this.$router.push({name:'home'})
        }
    },

}
</script>

<style scoped>

</style>
