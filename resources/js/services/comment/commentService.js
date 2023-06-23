import axios from "axios";

const commentService = {
    async addComment(data) {

        return await axios.post('/api/comments', data);
    },

    async fetchComments(id) {
        return await axios.get(`/api/comments/${id}`);
    },

    async updateComment(id, data) {
        return await axios.patch(`/api/comments/${id}`,data);
    },

    async exportComments(id) {
        return await axios.get(`/api/comments/export/${id}`,{responseType: 'blob'})
            .then(response => {
                let fileURL = window.URL.createObjectURL(new Blob([response.data]));
                let fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'comments.csv');
                document.body.appendChild(fileLink);
                fileLink.click();
            });
    }
}

export default commentService;
