<?php

namespace App\Repositories\Favorite;

use Illuminate\Database\Eloquent\Collection;

interface FavoriteRepositoryInterface
{
    public function addToFavorite($id): int;
    public function deleteFromFavorite($id): int;
    public function getFavorites(): Collection;
}
