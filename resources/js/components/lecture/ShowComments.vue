<template>
    <div class="mt-3">
        <v-dialog
            v-model="dialog"
            width="500"
        ><export-loading></export-loading></v-dialog>
        <v-layout justify-center>
            <v-card width="50%">
                <v-card-title class="text-h4">Comments {{quantity}}</v-card-title><hr width="90%" class="marg-auto">
                <v-card-subtitle v-show="is_admin"><v-btn @click="exportComments($route.params.id); dialog=true" color="blue" text>Export comments</v-btn></v-card-subtitle>
                <v-card-text>
                    <v-form @submit.prevent="addComment(newComment)">
                        <tiptap-vuetify
                            v-model="newComment.comment"
                            :extensions="extensions"
                            class="mb-2"
                        />
                        <v-btn color="secondary" type="submit">Send</v-btn>
                    </v-form>
                </v-card-text>

                <v-card-text class="text--primary">
                    <div v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="limit">
                        <v-card v-for="comment in comments" :key="comment.id" class="mb-2">
                            <v-card-title class="text-h6">{{comment.firstname}} {{comment.lastname}}</v-card-title>
                            <v-card-subtitle>{{new Date(comment.created_at).toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"})}}</v-card-subtitle>
                        <v-card-text class="text--primary" v-html="comment.comment">
                        </v-card-text>
                            <v-card-actions v-if="comment.user_id===user && (Math.round((((new Date() - new Date(comment.created_at)) % 86400000) % 3600000) / 60000)) < 10">
                                <v-btn text align="right" @click="editField = !editField">Edit</v-btn>
                            <v-card-text v-if="editField">
                                <v-form @submit.prevent="updateComment(comment)">
                                    <tiptap-vuetify
                                        v-model="comment.comment"
                                        :extensions="extensions"
                                        class="mb-2"
                                    />
                                    <v-btn text type="submit">Save</v-btn>
                                </v-form>
                            </v-card-text>
                            </v-card-actions>
                        </v-card>
                        <v-progress-circular v-if="loading" indeterminate color="primary"></v-progress-circular>
                    </div>
                </v-card-text>
            </v-card>
        </v-layout>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'
import auth from "../../services/auth/auth";
import ExportLoading from "../loader/ExportLoading";
export default {
    name: "ShowComments",
    data() {
        return {
            user: auth.user().id,
            is_admin: auth.user().role[0].name === 'admin',
            dialog: false,
            newComment: {
                user_id: 0,
                lecture_id: this.$route.params.id,
                comment: ''
            },
            editField: false,
            extensions: [
                History,
                Blockquote,
                Link,
                Underline,
                Strike,
                Italic,
                ListItem,
                BulletList,
                OrderedList,
                [Heading, {
                    options: {
                        levels: [1, 2, 3]
                    }
                }],
                Bold,
                Code,
                HorizontalRule,
                Paragraph,
                HardBreak
            ],
        }
    },
    components: {ExportLoading, TiptapVuetify },
    computed: mapState({
        comments: state => state.comment.comments,
        quantity: state => state.comment.quantity,
        loading: state => state.comment.loading,
        limit: state => state.comment.limit,
        busy: state => state.comment.busy
    }),
    mounted() {

    },
    methods: {
        ...mapActions('comment', ['getComments','addComment', 'updateComment','exportComments']),
        loadMore() {
            this.getComments(this.$route.params.id);
        },
        update(data) {
            this.updateComment(data);
        }
    },
}
</script>

<style scoped>

</style>
