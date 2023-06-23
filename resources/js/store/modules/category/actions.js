import categoryService from "../../../services/category/categoryService";

export default {
    async fetchCategoryList({commit}) {
        const response = await categoryService.getCategoryList()
        commit('setList',response.data);
    },

    async fetchCategories({commit}) {
        const response = await categoryService.getCategoryTree();
        commit('setCategories',response.data);
    },

    async deleteCategory({commit},data) {
        await categoryService.deleteCategory(data);
    },

    async addCategory({commit},data) {
        await categoryService.addCategory(data);
    }
}
