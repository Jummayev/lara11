<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected mixed $modelClass = Post::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->getQuery($request);
        $data = $query->get();

        return response()->json($data);
    }

    public function client(Request $request)
    {
        $query = $this->getQuery($request);
        $query->where('status', Post::STATUS_ACTIVE);
        $data = $query->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $model = $this->modelClass::create($data);

        return response()->json($model);
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $query = $this->getQuery($request);
        $model = $query->firstOrFail($id);

        return response()->json($model);
    }

    public function clientShow(Request $request, int $id)
    {
        $query = $this->getQuery($request);
        $query->where('status', Post::STATUS_ACTIVE);
        $model = $query->firstOrFail($id);

        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        $post->delete();

        return response()->json($post);
    }
}
