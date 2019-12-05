<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use File;
use App\Like;
use App\Comment;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addPostForm() {
        return view('posts.addPostForm');
    }

    public function addPost(Request $req) {
        $this->validate($req, [
            'titletext' => 'required',
            'contenttext' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if ($req->hasFile('cover_image')) {
            $filenameWithExt = $req->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $req->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'_'.$extension;
            $path = $req->file('cover_image')->move('cover_images', $filenameToStore);
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }

    	$post = new Post();
    	$post->title = $req->titletext;
    	$post->content = $req->contenttext;
    	$post->author_id = Auth()->user()->id;
        $post->cover_image = $filenameToStore;
    	$post->save();

    	
		return redirect('home');
    }

    public function allPosts() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('posts.allPosts')->with('posts', $posts);
    }

    public function editForm($postId) {
        $post = Post::find($postId);
        return view('posts.editForm')->with('post', $post);
    }

    public function editPost(Request $req) {
        $this->validate($req, [
            'titletext' => 'required',
            'contenttext' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
    	$post = Post::find($req->id);
    	$post->title = $req->titletext;
    	$post->content = $req->contenttext;
    	$post->save();

    	
		return redirect('home');
    }

    public function deletePost($id) {
        $post = Post::find($id);
        $post->delete();

        if ($post->cover_image != 'noimage.jpg') {
            File::Delete('cover_images/'.$post->cover_image);
        }

    	
    	return redirect('home');
    }

    public function guestViewPost($postId) {
        $post = Post::find($postId);
        $comments = Comment::where('post_id', '=', $postId)->get();
        //var_dump($comments);
        //if ($comments->first()==null) return "OK";
        //else return "No";
        return view('posts.guestViewPost', compact('post', 'comments'));
    }

    public function like($postId) {
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $like->post_id = $postId;
        $like->save();
        $count = Like::where('post_id', '=', $postId)->count();
        return ["Liked", $count];
    }

    public function liked($postId) {
        $like = Like::where('post_id', '=', $postId);
        $like->delete();
        $count = Like::where('post_id', '=', $postId)->count();
        return ["Like", $count];
    }

    public function comment($comments, $postId) {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = (int)$postId;
        $comment->comments = $comments;
        $comment->save();
        return "";
    }
}