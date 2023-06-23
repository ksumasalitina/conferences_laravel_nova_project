import './bootstrap';

import Vue from 'vue';
import GmapVue from 'gmap-vue';
import Vuetify from "vuetify";
import 'vuetify/dist/vuetify.min.css';
import App from './App.vue';
import VueAxios from 'vue-axios';
import ReadMore from 'vue-read-more';
import vueAwesomeCountdown from 'vue-awesome-countdown'
import axios from 'axios';
import router from './routes';
import store from './store/index'
let infiniteScroll =  require('vue-infinite-scroll');
import { TiptapVuetifyPlugin } from 'tiptap-vuetify'
import 'tiptap-vuetify/dist/main.css'
import * as frontendCredentials from './env/env';


const vuetify = new Vuetify();
Vue.use(TiptapVuetifyPlugin, {
    vuetify,
    iconsGroup: "mdi"
});
Vue.use(vueAwesomeCountdown,'vac');
Vue.use(infiniteScroll);
Vue.use(VueAxios, axios);
Vue.use(ReadMore);
Vue.use(GmapVue, {
    load: {
        key:frontendCredentials.GOOGLE_MAP_KEY,
        libraries: 'places'
    }
});
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router: router,
    store:store,
    render: h => h(App),
});


