import meetingService from "../../../services/meeting/meetingService";

export default {
   async getAllMeetings ({commit,state}, page) {
       const response = await meetingService.fetchAllMeetings(page);
       commit('setAllMeetings',response.data);
    },

    async getMeeting ({commit},id) {
        const response = await meetingService.fetchMeeting(id);
        commit('setMeeting',response.data.meeting);
    },

    async getMeetingsByFilter({commit}, data){
       const response = await meetingService.fetchMeetingsByFilter(data, data['page']);
       commit('setAllMeetings', response.data);
    },

    async searchMeetings({commit}, data) {
       const response = await meetingService.searchMeetings(data);
       commit('setMeeting', response.data);
    },

    async getCountries({commit}) {
       const response = await meetingService.fetchCountries();
       commit('setCountries',response.data)
    },

    async deleteMeeting({commit}, id) {
       await meetingService.deleteMeeting(id);
       commit('deleteMeeting',id);
    },

     async updateMeeting({commit}, data) {
        await meetingService.updateMeeting(data,data.id);
    },

    async createMeeting({commit},data) {
       await meetingService.createMeeting(data);
    },

    async join({commit},id) {
       await meetingService.joinMeeting(id);
        commit('joinMeeting',id);
    },

    async cancel({commit},id) {
       await meetingService.cancelParticipation(id);
        commit('cancelParticipation',id);
    },

    async exportMeetings({commit}) {
       await meetingService.exportMeetings();
    },

    async exportMembers({commit},id) {
        await meetingService.exportMembers(id);
    }
 }
