<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostSearchController extends Controller
{
    public function __invoke(Request $request): Collection
    {
        $query = Query::multiMatch()
            ->fields(Post::ELASTIC_FIELD_SEARCH)
            ->query($request->searchTerm)
            ->lenient(true);

        return Post::searchQuery($query)->execute()->documents();
    }
}
