export default {
    convertDate(UNIX_timestamp){
        let a = new Date(UNIX_timestamp * 1000);
        let months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        let year = a.getFullYear();
        let month = months[a.getMonth()];
        let date = a.getDate();
        return date + ' ' + month + ' ' + year;
    },

    convertTime(UNIX_timestamp){
        let a = new Date(UNIX_timestamp * 1000);
        let hour = a.getHours();
        let min = String(a.getMinutes()).padStart(2, "0");
        return hour + ':' + min;
    },

    convertInputDate(UNIX_timestamp) {
        let a = new Date(UNIX_timestamp * 1000);
        return a.getFullYear() + '-' + a.getMonth() + '-' + a.getDate();
    }
}
