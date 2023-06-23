import axios from "axios";

const lectureService = {
    async fetchLectureById(id) {
        return await axios.get(`/api/lectures/${id}`);
    },

    async fetchLecturesByMeeting(id) {
        return await axios.get(`/api/meetings/lectures/${id}`);
    },

    async searchLectures(data) {
        return await axios.get('/api/lectures/search', {params:data});
    },

    async fetchLecturesByFilter(data) {
        return await axios.get('/api/lectures/filter', {params:data});
    },

    async createLecture(data) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };
        return await axios.post('/api/lectures', data, config);
    },

    async deleteLecture(id) {
        return await axios.delete(`/api/lectures/${id}`);
    },

    async updateLecture(data) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };
        data._method = 'PUT';
        return await axios.post(`/api/lectures/${data.id}`, data, config);
    },

    async getSlots(id) {
        return await axios.get(`/api/meetings/slots/${id}`);
    },

    async fetchLectureByMeetingUser(id) {
         return await axios.get(`/api/meeting/${id}/lecture`);
    },

    async exportLectures(id) {
        return await axios.get(`/api/lectures/export/${id}`,{responseType: 'blob'})
            .then(response => {
                let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                let fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'lectures.csv');
                document.body.appendChild(fileLink);
                fileLink.click();
            });
    },

    async downloadPresentation(presentation) {
        return await axios.get(`/api/lectures/download/${presentation}`,{responseType: 'blob'})
            .then(response => {
                let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                let fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'presentation.pptx');
                document.body.appendChild(fileLink);
                fileLink.click();
            });
    }
};

export default lectureService;
