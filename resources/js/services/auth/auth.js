import axios from "axios";

const auth = {
    init: function() {
        const token = this.loggedIn();
        if (token) {
            axios.defaults.headers.common = { 'Authorization': `Bearer ${token}` };
        }
    },
    loggedIn: function() {
        if (!localStorage) return null;
        else return localStorage.getItem('token');
    },
    user: function() {
        return JSON.parse(localStorage.getItem('user') || '{}');
    },
    login: async function(data) {
        try {
            const response = await axios.post(`/api/login`, data);
            if (response.data.role[0].name==='admin'){
                window.location.href = "/nova/login";
                return false;
            } else {
            const token = response.data['access_token'];
            localStorage.setItem('token', token);
            axios.defaults.headers.common = { 'Authorization': `Bearer ${token}` };
            localStorage.setItem('user', JSON.stringify(response.data['user']));
            return true;}
        } catch (err) {
            return await Promise.reject(err.response);
        }
    },
    register: async function(data) {
        const response = await axios.post(`/api/register`, data);
        if (response.error) return false;
        const token = response.data['access_token'];
        localStorage.setItem('token', token);
        axios.defaults.headers.common = { 'Authorization': `Bearer ${token}` };
        localStorage.setItem('user', JSON.stringify(response.data['user']));
    },
    resetHeaders: function() {
        localStorage.removeItem('token');
        axios.defaults.headers.common = { 'Authorization': '' };
    },
    logout: function() {
        return axios.get(`/api/logout`)
            .then(res => {
                return auth.resetHeaders();
            });
    },
    update: async function (data) {
        if(this.user().email === data.email){
            data.email = null;
        }
        return await axios.put(`/api/profile/edit/${data.id}`,data);
    }
};

export default auth;
