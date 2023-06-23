import Vue from 'vue';
import Vuex from 'vuex';
import meeting from './modules/meeting/index';
import lecture from "./modules/lecture/index";
import comment from "./modules/comment/index";
import favorite from "./modules/favorite/index";
import category from "./modules/category/index";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        meeting,
        lecture,
        comment,
        favorite,
        category
    }
});
