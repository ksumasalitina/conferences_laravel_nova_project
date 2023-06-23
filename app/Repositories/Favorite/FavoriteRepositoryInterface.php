<?php

namespace App\Repositories\Favorite;

interface FavoriteRepositoryInterface
{
    public function addToFavorite($id);
    public function deleteFromFavorite($id);
    public function getFavorites();
}
