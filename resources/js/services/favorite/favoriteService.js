import axios from "axios";

const favoriteService = {
    async addToFavorite(id) {
        return await axios.post(`/api/favorites/add/${id}`);
    },

    async deleteFromFavorites(id) {
        return await axios.delete(`/api/favorites/delete/${id}`);
    },

    async fetchFavorites() {
        return await axios.get('/api/favorites');
    }
}

export default favoriteService;
