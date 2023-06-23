import favoriteService from "../../../services/favorite/favoriteService";

export default {
    async fetchFavorites({commit}) {
        const response =  await favoriteService.fetchFavorites();
        commit('setFavorites', response.data);
    },

    async fetchFavoritesCount({commit}) {
        const response = await favoriteService.fetchFavorites();
        commit('setCount', response.data.length);
    },

    async deleteFavorite({commit},id) {
        await favoriteService.deleteFromFavorites(id);
        commit('deleteFavorite',id);
    }
}
