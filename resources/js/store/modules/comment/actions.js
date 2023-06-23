import commentService from "../../../services/comment/commentService";

export default {
    async addComment({commit}, data) {
        await commentService.addComment(data);
        commit('postComment',data);
    },

    async getComments({commit}, id) {
        const response = await commentService.fetchComments(id);
        commit('setComments', response.data.comments);
        commit('setQuantity', response.data.quantity);
    },

    async updateComment({commit},data) {
        await commentService.updateComment(data.id,data);
    },

    async exportComments({commit},id) {
        await commentService.exportComments(id);
    }
}
