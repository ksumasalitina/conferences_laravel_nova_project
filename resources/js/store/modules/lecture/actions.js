import lectureService from "../../../services/lecture/lectureService";
import favoriteService from "../../../services/favorite/favoriteService";

export default {
    async getLecture({commit},id) {
        const response = await lectureService.fetchLectureById(id);
        commit('setLecture', response.data);
    },

    async getMeetingLectures({commit},id) {
        const response = await lectureService.fetchLecturesByMeeting(id);
        commit('setLecture', response.data);
    },

    async getLecturesByFilter({commit},data) {
        const response = await lectureService.fetchLecturesByFilter(data);
        commit('setLecture', response.data);
    },

    async searchLectures({commit}, data) {
        const response = await lectureService.searchLectures(data);
        commit('setLecture', response.data);
    },

    async getMeetingUserLecture({commit},id) {
        const response = await lectureService.fetchLectureByMeetingUser(id);
        commit('setLectureByMeetingUser', response.data);
    },

    async getSlots({commit},id) {
        const response = await lectureService.getSlots(id);
        commit('setSlots', response.data);
    },

    async createLecture({commit},data) {
         await lectureService.createLecture(data);
    },

    async updateLecture({commit}, data) {
        await lectureService.updateLecture(data.id, data);
    },

    async deleteLecture({commit}, id) {
        await lectureService.deleteLecture(id);
    },

    async addFavorite({commit, rootState}, id) {
        await favoriteService.addToFavorite(id);
        rootState.favorite.count += 1;
        commit('addFavorite',id);
    },

    async deleteFavorite({commit, rootState}, id) {
        await favoriteService.deleteFromFavorites(id);
        rootState.favorite.count -= 1;
        commit('deleteFavorite',id);
    },

    async exportLectures({commit}, id) {
        await lectureService.exportLectures(id);
    },

    async downloadPresentation({commit},presentation) {
        await lectureService.downloadPresentation(presentation);
    }
}
