<?php

namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentSortRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CommentSortRequest $request)
    {
        $data = $request->validated();
        $comments = Comment::whereNull('parent_id')->orderBy($data['sortField'] ?? 'created_at', $data['sortDirection'] ?? 'DESC')->paginate(25);
        
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, CommentService $service)
    {
        $data = $request->validated();
        $comment = Comment::create($data);

        if($request->file){
            $service->store($request, $comment->id);
        }
        broadcast(new CommentCreated($comment));

        return CommentResource::make($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return CommentResource::make($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);
        $comment->refresh();
        broadcast(new CommentCreated($comment));
        
        return CommentResource::make($comment);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted',
        ]);
    }
}
