export default {
    setFavorites(state, favorites) {
        state.favorites = favorites;
    },

    setCount(state, length) {
        state.count = length;
    },

    deleteFavorite(state, id) {
        let i = state.favorites.map(favorite => favorite.id).indexOf(id);
        state.favorites.splice(i, 1);
        state.count -= 1;
    }
}
