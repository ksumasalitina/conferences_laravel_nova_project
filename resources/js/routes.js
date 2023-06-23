import AllMeetings from "./components/meeting/AllMeetings";
import CreateMeeting from "./components/meeting/CreateMeeting";
import EditMeeting from "./components/meeting/EditMeeting";
import ShowMeeting from "./components/meeting/ShowMeeting";
import RegisterComponent from "./components/auth/RegisterComponent";
import LoginComponent from "./components/auth/LoginComponent";
import NoPermission from "./components/NoPermission";
import CreateLecture from "./components/lecture/CreateLecture";
import EditLecture from "./components/lecture/EditLecture";
import ShowLecture from "./components/lecture/ShowLecture";
import ShowLecturesByMeeting from "./components/lecture/ShowLecturesByMeeting";
import EditProfile from "./components/auth/EditProfile";
import ShowFavorites from "./components/favorite/ShowFavorites";
import ShowCategories from "./components/category/ShowCategories";
import SearchPage from "./components/search/SearchPage";
import ZoomList from "./components/zoom/ZoomList";
import PlansComponent from "./components/subscription/PlansComponent";
import PaymentForm from "./components/subscription/PaymentForm";
import Vue from "vue";
import VueRouter from "vue-router";
import auth from "./services/auth/auth";

Vue.use(VueRouter);
auth.init();

const router = new VueRouter({
    mode: 'history',
    routes: [
    {
        name: 'home',
        path: '/',
        component: AllMeetings
    },
    {
        name: 'create',
        path: '/create',
        component: CreateMeeting,
        meta: {
            requiresAuth: true,
            is_admin: true
        }
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditMeeting,
        meta: {
            requiresAuth: true,
            is_admin: true
        }
    },
    {
        name: 'details',
        path: '/details/:id',
        component: ShowMeeting,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: 'register',
        path: '/register',
        component: RegisterComponent
    },
    {
        name: 'login',
        path: '/login',
        component: LoginComponent
    },
    {
        name: 'create_lecture',
        path: '/lecture/create/:id',
        component: CreateLecture,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: 'edit_lecture',
        path: '/lecture/edit/:id',
        component: EditLecture,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: 'show_lecture',
        path: '/lecture/:id',
        component: ShowLecture,
        meta: {
            requiresAuth: true,
        }
    },
    {
         name: 'show_meeting_lectures',
         path: '/meeting/lectures/:id',
         component: ShowLecturesByMeeting,
         meta: {
            requiresAuth: true,
        }
    },
    {
        name:'edit_profile',
        path:'/profile/edit/:id',
        component: EditProfile,
        meta: {
            requiresAuth: true
        }
    },
    {
       name:'favorites',
       path:'/favorites',
       component: ShowFavorites,
       meta: {
            requiresAuth: true
        }
    },
    {
        name:'categories',
        path:'/categories',
        component: ShowCategories,
        meta: {
            requiresAuth: true,
            is_admin: true
        }
    },
    {
        name:'search',
        path:'/search',
        component: SearchPage,
        meta: {
           requiresAuth: true,
        }
    },
    {
        name:'zoom_list',
        path:'/zoom',
        component: ZoomList,
        meta: {
            requiresAuth: true,
            is_admin: true
        }
    },
    {
        name:'plans',
        path:'/plans',
        component: PlansComponent,
        meta: {
            requiresAuth: true
        }
    },
    {
        name:'payment',
        path:'/payment/:id',
        component: PaymentForm,
        meta: {
            requiresAuth: true
        }
    },
    {
        name:'403',
        path: '/403',
        component: NoPermission
    }
]});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!auth.loggedIn()) {
            next({name: "login"});
        }
        else next();
    }
    else next();

    if(to.matched.some(record => record.meta.is_admin)) {
        if (auth.user().role[0].name !== 'admin') next({name: '403'});
        else next();
    }
    else next();
});

export default router;
