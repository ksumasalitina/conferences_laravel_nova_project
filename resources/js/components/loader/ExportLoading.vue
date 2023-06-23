<template>
<v-card v>
    <v-card-title>Exporting file</v-card-title>

    <v-card-text v-if="!export_complete">
        <v-row justify="center">
            <v-col cols="7">Getting your files</v-col>
            <v-col cols="6">
         <v-progress-linear
            color="deep-purple accent-4"
            indeterminate
            rounded
            height="6"
        ></v-progress-linear></v-col>
        </v-row>
    </v-card-text>
    <v-card-text v-else>
        <v-row justify="center">
            <v-alert
                dense
                text
                type="success"
            >
                Export completed successfully!
            </v-alert>
        </v-row>
    </v-card-text>
</v-card>
</template>

<script>
export default {
    name: "ExportLoading",
    data(){
        return {
            export_complete: false
        }
    },
    mounted(){
        Echo.private(`export`)
            .listen('FinishedExport', (e) => {
                    this.export_complete = true;
            });
    }
}
</script>

<style scoped>

</style>
