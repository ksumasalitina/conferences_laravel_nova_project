<template>
<div>
    <h2 align="center">Create Lecture</h2>
    <v-layout justify-center>
        <v-flex xs4>
            <v-form @submit.prevent="createLecture">
                <v-text-field v-model="lecture.theme" label="Theme"></v-text-field>
                <v-select :items="list" item-text="name" item-value="id"
                    label="Select category" v-model="lecture.category"></v-select>
                <p>Choose time:</p>
                <v-select solo
                    v-model="lecture.slot_id"
                    label="Select time slot"
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
                    label="Upload presentation"
                ></v-file-input>
                <v-checkbox v-model="lecture.zoom" value="1" label="Online"></v-checkbox>
                <v-alert text dense color="teal" icon="mdi-clock-fast" border="left" v-if="lecture.zoom">
                    The link for zoom meeting will appear on the lecture page 10 minutes before lecture start.
                </v-alert>
                <v-btn color="yellow" type="submit">Save</v-btn>
            </v-form>
        </v-flex>
    </v-layout>
</div>
</template>

<script>
import lectureService from "../../services/lecture/lectureService";

import {mapState, mapActions} from "vuex";
export default {
    name: "CreateLecture",
    data() {
        return {
            lecture:{
                user_id:0,
                meeting_id: this.$route.params.id,
                slot_id:'',
                theme:'',
                category:'',
                description:'',
                presentation:[],
                zoom:null
            },
        }
    },
    computed: mapState({
        slots: state => state.lecture.slots,
        list: state =>state.category.list
    }),
    mounted() {
        this.getSlots(this.$route.params.id);
        this.fetchCategoryList();
    },
    methods: {
        ...mapActions('lecture',['getSlots', 'createLecture']),
        ...mapActions('meeting',['join']),
        ...mapActions('category',['fetchCategoryList']),
        createLecture(){

            this.lecture.presentation = this.lecture.presentation[0];
            lectureService.createLecture(this.lecture);
            this.join(this.$route.params.id).then(this.$router.push({name:'home'}));
        },
    }
}
</script>

<style scoped>

</style>
