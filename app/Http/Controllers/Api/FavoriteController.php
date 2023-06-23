<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Favorite\FavoriteRepositoryInterface;

class FavoriteController extends Controller
{
    private FavoriteRepositoryInterface $favoriteRepository;

    public function __construct(FavoriteRepositoryInterface $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function add($id)
    {
        $this->favoriteRepository->addToFavorite($id);

        return response()->json('Lecture added to favorites');
    }

    public function delete($id)
    {
        $this->favoriteRepository->deleteFromFavorite($id);

        return response()->json('Lecture deleted from favorites');
    }

    public function show()
    {
        return response()->json($this->favoriteRepository->getFavorites());
    }
}
