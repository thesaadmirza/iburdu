<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Comment;
use App\User;
use App\History;
use App\Notify;
use Auth;
use Validator;
use Markdown;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getComments']]);
    }

    public function store(Request $request)
    {
        $article = Article::find($request->article_id);
        if (empty($article))
            return response()->json(['status' => 404, 'msg' => 'Article Does Not Exist']);

        if (!$article->comment_status)
            return response()->json(['status' => 403, 'msg' => 'Article has disabled comments']);

        $rules = array(
            'body' => 'required',
        );
        $validation = Validator::make($commentData = $request->all(), $rules);
        if ($validation->fails())
            return response()->json(['status' => 0, 'msg' => 'Comment Content Cannot be Empty']);

        $user = Auth::user();
        $commentData['user_id'] = $user->id;
        $parsedComment = parseAt($commentData['body']);
        $atUidArr = $parsedComment['uidArr'];
        $commentData['body'] = Markdown::parse($parsedComment['comments']);
        $comment = Comment::create($commentData);
        $html = view('articles._comment', compact('comment'))->render();
        $comment->article->increment('comment_count');

        $user->histories()->create([
            'type' => 'comment',
            'content' => 'Review Article《<a href="/article/'.$article->id.'#comment-'.$comment->id.'" target="_blank">'.$article->title.'</a>》'
        ]);
        Notify::notify([$article->user_id], '<a href="/user/' . $user->id . 
                '" target="_blank">' . $user->name . '</a> Commented on your Aritcle <a href="/article/' . 
                $article->id.'#comment-'.$comment->id.'" target="_blank">' . 
                $article->title.'</a>', 'comment');
        if($atUidArr){
            Notify::notify($atUidArr, '<a href="/user/' . $user->id . 
                    '" target="_blank">' . $user->name . '</a> In the Article <a href="/article/' . 
                    $article->id.'#comment-'.$comment->id.'" target="_blank">' . 
                    $article->title.'</a> Mentioned you in the Comment', 'comment');
        }
        return response()->json(['status' => 200, 'msg' => 'Comment Successful', 'html' => $html]);
    }

    public function getComments(Request $request)
    {
        $article = Article::find($request->article_id);
        if (empty($article))
            return response()->json(['status' => 404, 'msg' => 'Article Does Not Exist']);
        $comments = $article->comments()->latest()->simplePaginate(10);
        $html = view('articles._comments', compact('comments'))->render();
        return response()->json(['status' => 200, 'html' => $html]);
    }
}
