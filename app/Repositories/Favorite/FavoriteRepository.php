<?php

namespace App\Repositories\Favorite;

use Illuminate\Database\Eloquent\Collection;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    public function addToFavorite($id): int
    {
        $user = auth('sanctum')->user();

        return $user->favorites()->attach($id);
    }

    public function deleteFromFavorite($id): int
    {
        $user = auth('sanctum')->user();

        return $user->favorites()->detach($id);
    }

    public function getFavorites(): Collection
    {
        $user = auth('sanctum')->user();

        return $user->favorites;
    }
}
