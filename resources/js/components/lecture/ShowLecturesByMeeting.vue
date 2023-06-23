<template>
<div>
    <filters-list class="mb-3"></filters-list>
    <v-dialog
        v-model="dialog"
        width="500"
    ><export-loading></export-loading></v-dialog>
    <v-row>
        <v-col v-for="lecture in lectures" :key="lecture.id">
            <v-badge :content="lecture.status" overlap>
            <v-card width="300px">
                <v-card-title>{{lecture.theme}}</v-card-title>
                <v-card-text class="text--primary">{{lecture.start}} - {{lecture.end}}</v-card-text>
                <v-card-text><read-more more-str="more" :text="lecture.description" link="#" less-str="less" :max-chars="100"></read-more></v-card-text>
                <v-card-actions>
                    <v-btn v-if="lecture.user_id === user" :to="{name:'edit_lecture',params:{id:lecture.id}}" color="blue" text>Edit</v-btn>
                    <v-btn :to="{name:'show_lecture',params:{id:lecture.id}}" color="blue" text>Details</v-btn>
                    <v-btn v-if="lecture.is_favorite" @click="deleteFavorite(lecture.id)" text><v-icon>mdi-cards-heart</v-icon></v-btn>
                    <v-btn v-else-if="!lecture.is_favorite" @click="addFavorite(lecture.id)" text><v-icon>mdi-cards-heart-outline</v-icon></v-btn>
                </v-card-actions>
            </v-card>
            </v-badge>
        </v-col>
    </v-row>
</div>
</template>

<script>
import auth from "../../services/auth/auth";
import {mapState, mapActions} from "vuex";
import FiltersList from "./FiltersList";
import ExportLoading from "../loader/ExportLoading";
export default {
    name: "ShowLecturesByMeeting",
    components: {ExportLoading, FiltersList},
    data() {
        return {
            user: auth.user().id,
            dialog: false
        }
    },
    computed: mapState({
        lectures: state => state.lecture.lectures,
    }),
    async mounted() {
        await this.getMeetingLectures(this.$route.params.id);
    },

    methods: {
        ...mapActions('lecture',['getMeetingLectures', 'addFavorite', 'deleteFavorite','getLecturesByFilter']),
    }
}
</script>

<style scoped>

</style>
