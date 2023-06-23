<template>
<div>
    <v-row>
        <v-col v-for="plan in plans" :key="plan.id">
            <v-card elevation="8">
                <v-system-bar v-if="plan.id != current.id" color="blue" dark height="40px"></v-system-bar>
                <v-system-bar v-else color="green" dark height="40px"></v-system-bar>
                <v-card-title class="text-center">{{plan.name}}</v-card-title>
                <v-card-subtitle>{{plan.price}}$ / month</v-card-subtitle>
                <v-card-text class="text-center text--primary text-h6" style="text-transform: uppercase">
                    {{plan.description}}
                </v-card-text>
                <v-card-actions v-if="plan.id != current.id">
                    <v-btn :to="{name: 'payment', params:{id:plan.id}}" color="blue" text>Upgrade</v-btn>
                </v-card-actions>
                <v-card-actions v-else><v-btn color="green" text>Current plan</v-btn></v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</div>
</template>

<script>
import planService from "../../services/plan/planService";
export default {
    name: "PlansComponent",
    data() {
        return {
            plans: [],
            current: []
        }
    },
    mounted() {
        planService.fetchAllPlans().then(res => {this.plans = res.data});
        planService.fetchCurrentPlan().then(res => {this.current = res.data});
    }
}
</script>

<style scoped>

</style>
