export default {
    setAllMeetings(state, meeting) {
        state.meetings = meeting.data;
        state.current_page = meeting.current_page;
        state.total_pages = meeting.last_page;
        state.skeleton_loader = false;
    },

    setMeeting(state, meeting) {
        state.meetings = meeting;
        state.category = meeting.category[0].name
    },

    setCountries(state, countries) {
        state.countries = countries;
    },

    deleteMeeting(state, data) {
        let i = state.meetings.map(meeting => meeting.id).indexOf(data);
        state.meetings.splice(i, 1);
    },

    joinMeeting(state, id) {
        let i = state.meetings.map(product => product.id).indexOf(id);
        state.meetings[i].is_joined = true;
    },

    cancelParticipation(state, id) {
        let i = state.meetings.map(product => product.id).indexOf(id);
        state.meetings[i].is_joined = false;
    }
}
