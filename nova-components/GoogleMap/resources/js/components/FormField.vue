<template>
    <div class="flex flex-col md:flex-row -mx-6 px-6 py-2 md:py-0 space-y-2 md:space-y-0">
        <div class="md:w-1/3 md:py-3 px-6 md:px-8 mt-2 md:mt-0 w-full md:py-5">
            <div class="md:w-1/4 md:py-3">
                <h4 class="font-bold md:font-normal">
                    <span>Latitude</span>
                </h4>
            </div>
            <div class="md:w-3/4 md:py-3 break-all lg:break-words">
                <input
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    v-model="lat"
                    name="lat"
                />
            </div>
            <div class="md:w-1/4 md:py-3">
                <h4 class="font-bold md:font-normal">
                    <span>Longitude</span>
                </h4>
            </div>
            <div class="md:w-3/4 md:py-3 break-all lg:break-words">
                <input
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    v-model="lng"
                    name="lng"
                />
            </div>
        </div>
        <div class="md:w-3/5 md:py-3 break-all lg:break-words">
            <div with="80%">
                <g-map-component @update-coords="getCoords" :lat="lat" :lng="lng"
                                      :draggable="true"></g-map-component>
            </div>
        </div>
    </div>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'
import GMapComponent from "./GMapComponent";

export default {
    components: {GMapComponent},
    mixins: [FormField, HandlesValidationErrors],
    component: {
        GMapComponent
    },
    data() {
        return {
            lat: '',
            lng: ''
        }
    },
    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.lat = this.field.value.latitude || ''
            this.lng = this.field.value.longitude || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            this.fillIfVisible(formData, 'latitude', this.lat);
            this.fillIfVisible(formData, 'longitude', this.lng);
        },

        getCoords: function (data) {
            this.lat = data.lat;
            this.lng = data.lng;
        }
    },
}
</script>

