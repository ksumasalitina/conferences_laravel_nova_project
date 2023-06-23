<template>
<div>
    <v-btn color="yellow"  @click="showMenu =! showMenu">Filters</v-btn>
        <v-card v-if="showMenu" width="25%" class="mt-2">
            <v-card-text>
                <v-form>
                    <v-slider
                        v-model="filters.lectures"
                        label="Lectures"
                        thumb-color="red"
                        thumb-label="always"
                        max="10"
                        min="0"
                        @change="filter"
                    ></v-slider>

                <!--First date-->
                    <v-menu
                        ref="datepicker"
                        v-model="datepicker"
                        :close-on-content-click="false"
                        :return-value.sync="filters.first_date"
                        transition="scale-transition"
                        offset-y
                        min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="filters.first_date"
                                label="Date from"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker v-model="filters.first_date" no-title scrollable>
                            <v-btn text color="primary" @click="datepicker = false">
                                Cancel
                            </v-btn>
                            <v-btn text color="primary" @click="filter(); $refs.datepicker.save(filters.first_date)">
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>

                <!--Last date-->
                    <v-menu
                        ref="datepicker2"
                        v-model="datepicker2"
                        :close-on-content-click="false"
                        :return-value.sync="filters.last_date"
                        transition="scale-transition"
                        offset-y
                        min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="filters.last_date"
                                label="Date to"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                                @change="filter"
                            ></v-text-field>
                        </template>
                        <v-date-picker v-model="filters.last_date" no-title scrollable>
                            <v-btn text color="primary" @click="datepicker2 = false">
                                Cancel
                            </v-btn>
                            <v-btn text color="primary" @click="filter(); $refs.datepicker2.save(filters.last_date)">
                                OK
                            </v-btn>
                        </v-date-picker>
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
                            <v-btn text color="blue" @click="exportMeetings(); $parent.dialog = true">Export meetings</v-btn>
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
    name: 'CategoryList',
    data(){
        return {
            showMenu: false,
            datepicker: false,
            datepicker2: false,
            is_admin: auth.user().role[0].name === 'admin',
            filters: {
                lectures: false,
                category: null,
                first_date: null,
                last_date: null
            }
        }
    },
    computed:mapState({
        list: state => state.category.list
    }),

    mounted(){
        this.fetchCategoryList();
    },
    methods: {
        ...mapActions('category',['fetchCategoryList']),
        ...mapActions('meeting',['exportMeetings']),
        filter(){
            let result = {};
            result['page'] = 1;
            if(this.filters.lectures >= 1) result['lectures'] = this.filters.lectures;
            if(this.filters.first_date) result['first_date'] = this.filters.first_date;
            if(this.filters.last_date) result['last_date'] = this.filters.last_date;
            if(this.filters.category) result['category'] = this.filters.category;
            this.$parent.filters = result;
            this.$parent.getMeetingsByFilter(result);
        },
        clear() {
            this.filters = {
                lectures: 0,
                category: null,
                first_date: null,
                last_date: null
            };
            this.$parent.filters = null;
            this.$parent.getAllMeetings(1);
        }
    }
}

</script>
