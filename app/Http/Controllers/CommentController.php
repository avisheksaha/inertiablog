<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function store (Request $request, $postId)
   {
       $comment = $this->validate($request,[
            'comment'=>['required', 'max:500']
       ]);
    //    $cc = Comment::where('post_id',$postId)->count();
    //    dd($cc);
       Comment::create([
           'user_id' => auth()->user()->id,
           'post_id' => $postId,
           'comment' => $request->comment
       ]);

       session()->flash('success', 'Post is stored successfully');

       return redirect()->back();
   }
}
