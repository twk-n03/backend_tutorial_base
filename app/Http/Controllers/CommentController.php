<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $userId = $request->query('userId');

        // コメントの新規作成
        $comment = Comment::create([
            'article_id' => $articleId,
            'user_id' => $userId,
            'content' => $request->input('content')
        ]);

        return response()->json($comment, 201);
        
    }
    
    public function index($articleId)
    {
        // コメントの一覧取得
        $comments = Comment::where('article_id', $articleId)->get();
        return response()->json($comments);
    }
    
    public function destroy(Request $request, $articleId, $commentId)
    {
        $userId = $request->query('userId');

        // コメントの削除
        $comment = Comment::where('article_id', $articleId)
            ->where('id', $commentId)
            ->first();

        if(!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        if($comment->user_id != $userId){
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted'], 200);
    }

    public function update(Request $request, $articleId, $commentId)
    {
        $userId = $request->query('userId');

        // コメントの更新
        $comment = Comment::where('article_id', $articleId)
            ->where('id', $commentId)
            ->first();

        if(!$comment) {
            return response()->json([
                'message' => 'Comment not found'
            ], 404);
        }

        $comment->content = $request->input('content');
        $comment->save();

        return response()->json($comment);

    }
}
