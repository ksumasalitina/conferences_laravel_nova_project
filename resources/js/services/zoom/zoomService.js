import axios from "axios";

export default {
    async fetchZoomList(){
        return await axios.get('/api/zoom/list');
    }
}
