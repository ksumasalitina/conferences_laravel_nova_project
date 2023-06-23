<template>
<div style="padding: 10px">
    <h5>Current plan: </h5>
    <p style="color: green">{{current_plan.name}}</p>
    <p style="color: red">Joins left: {{current_plan.joins}}</p>
    <v-btn :to="{name:'plans'}" color="green" v-if="current_plan.id == 1" text>Upgrade subscription</v-btn>
    <v-btn color="red" v-else text @click="cancel">Cancel subscription</v-btn>
</div>
</template>

<script>
import planService from "../../services/plan/planService";
export default {
    name: "SubscriptionButton",
    data() {
        return {
            current_plan: []
        }
    },
    mounted() {
        planService.fetchCurrentPlan().then(res => {this.current_plan = res.data});
    },
    methods: {
        cancel() {
            planService.cancelSubscription()
                .then((res)=>{ this.$router.go(0);});
        }
    }
}
</script>

<style scoped>

</style>
