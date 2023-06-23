import axios from "axios";

const planService = {
    async fetchAllPlans() {
        return await axios.get('/api/plan/list');
    },

    async fetchCurrentPlan() {
        return await axios.get('/api/plan/current');
    },

    async fetchPlanById(id) {
      return await axios.get(`/api/plan/${id}`);
    },

    async subscribe(data) {
        return await axios.post('/api/plan/subscribe',data);
    },

    async cancelSubscription() {
        return await axios.get('/api/plan/cancel');
    }
}

export default planService;
