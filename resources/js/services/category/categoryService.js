import axios from "axios";

const categoryService = {
    async getCategoryList() {
        return await axios.get('/api/categories/list');
    },

    async getCategoryTree() {
        return await axios.get('/api/categories');
    },

    async addCategory(data) {
        return await axios.post('/api/category', data);
    },

    async deleteCategory(data) {
        return await axios.post('/api/category/delete', data);
    }
};

export default categoryService;
