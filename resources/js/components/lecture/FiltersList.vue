<template>
    <div>
        <v-btn color="yellow"  @click="showMenu =! showMenu">Filters</v-btn>
        <v-card v-if="showMenu" width="25%" class="mt-2">
            <v-card-text>
                <v-form>

                <!--Start time-->
                    <v-menu
                        ref="timepicker"
                        v-model="timepicker"
                        :close-on-content-click="false"
                        :return-value.sync="filters.start_time"
                        transition="scale-transition"
                        offset-y
                        min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="filters.start_time"
                                label="Start time"
                                prepend-icon="mdi-clock"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-time-picker v-model="filters.start_time" format="24h"
                                       :allowed-minutes="allowedMinutes"
                                       :allowed-hours="allowedHours">
                            <v-btn text color="primary" @click="timepicker = false">
                                Cancel
                            </v-btn>
                            <v-btn text color="primary" @click="filter(); $refs.timepicker.save(filters.start_time)">
                                OK
                            </v-btn>
                        </v-time-picker>
                    </v-menu>

                <!--End time-->
                    <v-menu
                        ref="timepicker2"
                        v-model="timepicker2"
                        :close-on-content-click="false"
                        :return-value.sync="filters.end_time"
                        transition="scale-transition"
                        offset-y
                        min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="filters.end_time"
                                label="End time"
                                prepend-icon="mdi-clock"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-time-picker v-model="filters.end_time" format="24h"
                                       :allowed-minutes="allowedMinutes"
                                       :allowed-hours="allowedHours">
                            <v-btn text color="primary" @click="timepicker2 = false">
                                Cancel
                            </v-btn>
                            <v-btn text color="primary" @click="filter(); $refs.timepicker2.save(filters.end_time)">
                                OK
                            </v-btn>
                        </v-time-picker>
                    </v-menu>

                    <v-select
                        v-model="filters.category"
                        :items="list"
                        item-text="name"
                        item-value="id"
                        label="Category"
                        required
                        multiple
                        @change="filter"
                    ></v-select>
                    <v-row>
                        <v-col>
                            <v-btn text color="red" @click="clear">Clear</v-btn>
                        </v-col>
                        <v-col v-show="is_admin">
                            <v-btn text color="blue" @click="exportLectures($route.params.id); $parent.dialog = true">Export lectures</v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import {mapState, mapActions} from 'vuex';
import auth from "../../services/auth/auth";
export default {
    name: "FiltersList",
    data () {
        return {
            showMenu: false,
            timepicker: false,
            timepicker2: false,
            is_admin: auth.user().role[0].name === 'admin',
            filters: {
                start_time: null,
                end_time: null,
                category: null
            },
        }
    },
    computed:mapState({
        list: state => state.category.list
    }),
    mounted() {
        this.fetchCategoryList();
    },
    methods: {
        ...mapActions('category',['fetchCategoryList']),
        ...mapActions('lecture',['exportLectures']),
        filter(){
            let result = {};
            result['id'] = this.$route.params.id;
            if(this.filters.start_time) result['start_time'] = this.filters.start_time;
            if(this.filters.end_time) result['end_time'] = this.filters.start_time;
            if(this.filters.category) result['category'] = this.filters.category;

            this.$parent.getLecturesByFilter(result);
        },
        clear(){
            this.filters = {
                start_time: null,
                end_time: null,
                category: null
            };
            this.$parent.getMeetingLectures(this.$route.params.id);
        },
        allowedMinutes: v => v === 0,
        allowedHours: v => v >= 10 && v <= 20,
    }
}
</script>

<style scoped>

</style>
