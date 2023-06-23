<?php

namespace App\Repositories\Favorite;

class FavoriteRepository implements FavoriteRepositoryInterface
{

    public function addToFavorite($id)
    {
        $user = auth('sanctum')->user();

        return $user->favorites()->attach($id);
    }

    public function deleteFromFavorite($id)
    {
        $user = auth('sanctum')->user();

        return $user->favorites()->detach($id);
    }

    public function getFavorites()
    {
        $user = auth('sanctum')->user();

        return $user->favorites;
    }
}
