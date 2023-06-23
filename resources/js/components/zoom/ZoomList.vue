<template>
    <div>
    <v-simple-table>
        <template v-slot:default>
            <thead>
            <tr>
                <th class="text-left">Lecture</th>
                <th class="text-left">Uuid</th>
                <th class="text-left">Id</th>
                <th class="text-left">Host id</th>
                <th class="text-left">Type</th>
                <th class="text-left">Start time</th>
                <th class="text-left">Timezone</th>
                <th class="text-left">Created at</th>
                <th class="text-left">Join url</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in zoom" :key="item.id">
                <td><router-link :to="{name:'show_lecture', params:{id:item.lecture_id}}">{{item.topic}}</router-link></td>
                <td>{{ item.uuid }}</td>
                <td>{{item.id}}</td>
                <td>{{ item.host_id }}</td>
                <td>{{ item.type }}</td>
                <td>{{ item.start_time }}</td>
                <td>{{ item.timezone }}</td>
                <td>{{ item.created_at }}</td>
                <td><a :href="item.join_url">{{item.join_url}}</a></td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
    </div>
</template>

<script>
import zoomService from "../../services/zoom/zoomService";
export default {
    name: "ZoomList",
    data(){
        return{
            zoom:null
        }
    },
    mounted() {
        zoomService.fetchZoomList().then(res=>{this.zoom = res.data.data.meetings;});
    }
}
</script>

<style scoped>

</style>
