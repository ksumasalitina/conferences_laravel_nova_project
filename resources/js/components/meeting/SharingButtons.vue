<template>
    <div class="dropup-center dropup f-inline">
        <v-menu top offset-x>
        <template v-slot:activator="{ on, attrs }">
            <v-btn class="mx-2" fab dark small v-bind="attrs" v-on="on" color="green">
                <v-icon>mdi-share-variant</v-icon>
            </v-btn>
        </template>
        <v-list>
            <v-list-item>
                <v-list-item-content>
                    <facebook-button
                        url=""
                        description="Check out this Meetup with SoCal AngularJS!"
                    />
                </v-list-item-content>
            </v-list-item>
            <v-list-item>
                <v-list-item-content>
                    <twitter-button
                        url=""
                        description="Check out this Meetup with SoCal AngularJS!"
                    />
                </v-list-item-content>
            </v-list-item>
        </v-list>

        </v-menu>
    </div>
</template>

<script>
import TwitterButton from "vue-share-buttons/src/components/TwitterButton";
import FacebookButton from "vue-share-buttons/src/components/FacebookButton";
export default {
    name: "SharingButtons",
    components: {TwitterButton, FacebookButton}
}
</script>

<style scoped>

</style>
