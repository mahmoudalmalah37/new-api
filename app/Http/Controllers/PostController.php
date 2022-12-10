<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::all();
        if ($posts) {
            return response()->json([
                'success' => true,
                'data' => $posts
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No posts found'
            ], 404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $post =  Post::create($request->all());
        if ($post) {
            return response()->json([
                'success' => true,
                'data' => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $post = Post::find($id);
        if ($post) {
            return response()->json($post);
        } else {
            return response()->json(['message' => 'id not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request,int $id): JsonResponse
    {
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return response()->json($post);
        } else {
            return response()->json(['message' => 'id not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Post::destroy($id);
        return response()->json(['message' => 'Post deleted']);
    }

    /**
     * search the specified resource from storage.
     *
     * @param $name
     * @return JsonResponse
     */

    public function search($name): JsonResponse
    {
        $post = Post::where('name', 'like', '%' . $name . '%')->get();
        if ($post) {
            return response()->json($post);
        } else {
            return response()->json(['message' => 'name not found'], 404);
        }
    }
}
