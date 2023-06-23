<template>
    <div id="map" style=" height: 400px; width: 100%;"></div>
</template>

<script>

export default {
    name: "GoogleMapComponent",
    props: {
        lat: [String, Number],
        lng: [String, Number],
        draggable: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            marker: null,
            map: null
        }
    },
    watch: {
        coords: function (val) {
            this.updateMarker();
        }
    },
    computed: {
        coords: function () {
            if (this.lat !== '' && this.lng !== '') {
                return {lat: parseFloat(this.lat), lng: parseFloat(this.lng)};
            }
            return null;
        }
    },
    created() {
        window.initMap = this.initMap;
    },
    mounted() {
        const plugin = document.createElement("script");
        plugin.setAttribute(
            "src",
            "https://maps.googleapis.com/maps/api/js?key=AIzaSyB-f9lZuh5R8fiXj5SRBETYEeWEdNwSUlE&callback=initMap&v=weekly"
        );
        plugin.async = true;
        document.head.appendChild(plugin);
    },
    methods: {
        setCoords(item) {
            this.$emit('update-coords', item)
        },
        createMarker() {
            let pos = 0;
            if (!this.coords) pos = {lat: 50.454512681663346, lng: 30.525384765625017};
            else pos = this.coords;
            this.marker = new google.maps.Marker({
                    position: pos,
                    map: this.map,
                    draggable: this.draggable
                });

            if(this.draggable) {
                this.marker.addListener('dragend', (e) => {
                    let coords = {
                        lat: e.latLng.lat(),
                        lng: e.latLng.lng()
                    }
                    this.setCoords(coords);
                });
            }
        },

        updateMarker() {
            this.marker.setPosition(this.coords);
            this.map.setCenter(this.coords);
            this.marker.setMap(this.map);
        },

        initMap() {
            this.map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: {lat: 50.454512681663346, lng: 30.525384765625017},
            });

            this.createMarker();
        }
    },

}
</script>
