<template>
<div>
    <h2 align="center">Edit Lecture</h2>
    <v-layout justify-center>
        <v-flex xs4>
            <v-form @submit.prevent="update">
                <v-text-field v-model="lecture.theme" label="Theme"></v-text-field>
                <v-select :items="list" item-text="name" item-value="id"
                    label="Select category" v-model="lecture.category"></v-select>
                <p>Chosen time: {{lecture.start}} - {{lecture.end}}</p>
                <v-select solo
                          v-model="lecture.slot_id"
                          label="Select different time slot"
                          :items="slots"
                          :item-text="item => item.start +' - '+ item.end"
                          item-value="id"
                ></v-select>
                <v-textarea v-model="lecture.description" label="Description"></v-textarea>
                <v-file-input
                    v-model="lecture.presentation"
                    accept=".ppt,.pptx"
                    show-size
                    counter
                    multiple
                    label="Upload new presentation"
                ></v-file-input>
                <v-btn color="yellow" type="submit">Save</v-btn>
            </v-form>
        </v-flex>
    </v-layout>
</div>
</template>

<script>
import lectureService from "../../services/lecture/lectureService";
import {mapActions, mapState} from "vuex";
export default {
    name: "EditLecture",
    computed: mapState({
        lecture: state => state.lecture.lectures,
        slots: state => state.lecture.slots,
        list: state => state.category.list
    }),
    async mounted() {
        await this.getLecture(this.$route.params.id);
        this.getSlots(this.lecture.meeting_id);
        this.fetchCategoryList();
    },
    methods: {
        ...mapActions('lecture',['getSlots','getLecture','updateLecture']),
        ...mapActions('category',['fetchCategoryList']),
        update() {
            if((typeof this.lecture.presentation) === 'string'){
                this.lecture.presentation = null;
            }
            else {
                this.lecture.presentation = this.lecture.presentation[0];
            }

            lectureService.updateLecture(this.lecture)
                .then(this.$router.push({name:'show_meeting_lectures', params:{id:this.lecture.meeting_id}}))
        }
    }
}
</script>

<style scoped>

</style>
