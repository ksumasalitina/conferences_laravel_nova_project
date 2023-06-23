<template>
    <div>
        <v-form>
            <v-text-field v-model="search.title" label="Search" @input="searchMeetings(search); searchLectures(search)"></v-text-field>
        </v-form>
        <v-row>
            <v-col cols="9">
                <v-list v-for="meeting in meetings" :key="meeting.id" v-if="type==1 || type==null">
                    <v-list-item>
                        <v-icon class="mr-2">mdi-account-group</v-icon>
                        <router-link class="nav-link" style="color:darkslategrey" :to="{name: 'details', params: {id: meeting.id}}">
                            {{meeting.title}}
                        </router-link>
                        <p style="color:lightgray" class="ml-2 mr-5">(Meeting)</p>
                    </v-list-item>
                </v-list>
                <v-list v-for="lecture in lectures" :key="lecture.id" v-if="type==2 || type==null">
                    <v-list-item>
                        <v-icon class="mr-2">mdi-presentation-play</v-icon>
                        <router-link class="nav-link" style="color:darkslategrey" :to="{name:'show_lecture',params:{id:lecture.id}}">
                            {{lecture.theme}}
                        </router-link>
                        <p style="color:lightgray" class="ml-2 mr-15">(Lecture)</p>
                    </v-list-item>
                </v-list>
            </v-col>
            <v-col style="border-left: 1px solid black">
                <v-radio-group v-model="type">
                    <v-radio
                        label="Meetings"
                        value="1"
                    ></v-radio>
                    <v-radio
                        label="Lectures"
                        value="2"
                        color="red"
                    ></v-radio>
                </v-radio-group>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import {mapState, mapActions} from "vuex";

export default {
    name: "SearchPage",
    data(){
        return {
            search: {title:''},
            type: null
        }
    },
    computed: mapState({
        meetings: state => state.meeting.meetings,
        lectures: state => state.lecture.lectures
    }),
    methods: {
        ...mapActions('meeting',['searchMeetings']),
        ...mapActions('lecture',['searchLectures']),
    }
}
</script>
