import auth from "../../../services/auth/auth";
export default {
    postComment(state, data) {
        state.comments.unshift({
            user_id: auth.user().id,
            firstname: auth.user().first_name,
            lastname:  auth.user().last_name,
            comment: data.comment,
            created_at: new Date()
        })
    },

    setComments(state, comments) {
        state.loading = true;
        state.busy = true;
        const append = comments.slice(
            state.comments.length,
            state.comments.length + state.limit
        );
        state.comments = state.comments.concat(append);
        state.busy = false
        if(state.comments.length === state.quantity){
            state.loading = false;
        }

    },
    setQuantity(state,quantity) {
        state.quantity = quantity;
    }
}
