import axios from "axios";
const meetingService = {
    async fetchAllMeetings(page) {
        return await axios.get('/api/meetings?page='+page);
    },

    async fetchMeeting(id) {
        return await axios.get(`/api/meetings/${id}`);
    },

    async fetchMeetingsByFilter(data, page) {
        return await axios.get('/api/meetings/filter?page='+page, {params:data});
    },

    async searchMeetings(data) {
      return await axios.get('/api/meetings/search', {params:data});
    },

    async createMeeting(data) {
        return await axios.post('/api/meetings/',data);
    },

    async fetchCountries() {
        return await axios.get('/api/countries/');
    },

    async updateMeeting(data,id) {
        return await axios.patch(`/api/meetings/${id}`, data);
    },

    async deleteMeeting(id) {
        return await axios.delete(`/api/meetings/${id}`);
    },

    async joinMeeting(id) {
        return await axios.post(`/api/join/${id}`);
    },

    async cancelParticipation(id) {
        return await axios.post(`/api/cancel/${id}`);
    },

    async exportMeetings() {
        return await axios.get(`/api/meetings/export`,{responseType: 'blob'})
            .then(response => {
                let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                let fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'meetings.csv');
                document.body.appendChild(fileLink);
                fileLink.click();
            });
    },

    async exportMembers(id) {
        return await axios.get(`/api/meetings/export/members/${id}`,{responseType: 'blob'})
            .then(response => {
                let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                let fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'members.csv');
                document.body.appendChild(fileLink);
                fileLink.click();
            });
    }
}

export default meetingService;
