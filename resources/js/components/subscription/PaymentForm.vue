<template>
    <v-app>
        <v-main>
            <v-container>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md6>
                        <v-dialog v-model="flash_message"><success-message></success-message></v-dialog>
                        <v-card class="elevation-12" >
                            <v-toolbar dark color="green">
                                <v-toolbar-title>Payment form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <div>
                                    <h5>Plan: {{plan.name}}</h5>
                                    <p>{{plan.description}}</p>
                                    <p>{{plan.price}} $</p>
                                </div>
                                <form ref="form" id="payment-form" @submit.prevent="pay">
                                    <v-text-field
                                        id="card-holder"
                                        v-model="holder_name"
                                        name="name"
                                        label="Name On Card"
                                        type="text"
                                        placeholder="John Smith"
                                        required
                                    ></v-text-field>
                                    <div id="card-element" class="mt-3 mb-3"></div>
                                    <v-col class="text-right">
                                        <v-btn type="submit" color="green" outlined id="pay-btn">Pay</v-btn>
                                    </v-col>
                                </form>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import planService from "../../services/plan/planService";
import {STRIPE_KEY} from "../../env/env";
import SuccessMessage from "./SuccessMessage";
export default {
    name: "PaymentForm",
    components: {SuccessMessage},
    data(){
        return{
            plan: [],
            holder_name: '',
            cardNumberElement: null,
            stripe: null,
            payment: {
                'plan': null,
                'token': null
            },
            flash_message: false
        }
    },
    mounted() {
        this.cardElement();
        planService.fetchPlanById(this.$route.params.id).then(res => {this.plan = res.data});
    },

    methods: {
        cardElement() {
            const stripe = Stripe(STRIPE_KEY);
            this.stripe = stripe;
            const elements = stripe.elements()
            const cardElement = elements.create('card')
            cardElement.mount('#card-element')
            this.cardNumberElement = cardElement;
        },
        async pay() {
            const cardBtn = document.getElementById('pay-btn');
            cardBtn.disabled = true;

            let paymentMethod = {
                payment_method: {
                    card: this.cardNumberElement,
                    billing_details: {
                        name: this.holder_name
                    }
                }
            };

            const {setupIntent, error} = await this.stripe.confirmCardSetup(
                this.plan.intent.client_secret, paymentMethod)

            if (error) {
                cardBtn.disable = false
            } else {
                this.payment = {
                    'plan': this.plan.id,
                    'token': setupIntent.payment_method
                }
                await planService.subscribe(this.payment);
                this.flash_message = true;
                setTimeout(() => {
                    this.$router.push({name: 'home'});
                },3000);
            }
        }
    }
}
</script>

<style scoped>

</style>
