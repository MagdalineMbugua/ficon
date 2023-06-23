<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group posts
 */
class PostController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     * list paginated posts
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with(['media', 'comments'])->paginate());
    }

    /**
     * @param CreatePostRequest $request
     * @return PostResource
     */
    public function store(CreatePostRequest $request): PostResource
    {
        $post = $request->validated();
        $mediaFiles = $post->media;
        collect($mediaFiles)->each(fn($media) => Media::create($mediaFiles->toArray));
        return new PostResource(Post::create([$post->caption, $post->on_sale])->load('media'));
    }

    /**
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post->load('media'));
    }

    /**
     * @param Post $post
     * @param UpdatePostRequest $request
     * @return PostResource
     */
    public function update(Post $post, UpdatePostRequest $request): PostResource
    {
        return new PostResource((tap($post)->update($request->validated()))->load('media'));
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
