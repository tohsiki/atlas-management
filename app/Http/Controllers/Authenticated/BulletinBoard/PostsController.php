<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments')->get();
        $categories = MainCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')
            ->orWhereHas('subCategories', function($query) use ($request) {
                $query->where('sub_category', 'like', '%'.$request->keyword.'%');
            })->get();

        }else if($request->category_word){
             $sub_category = $request->category_word;
             $posts = Post::with('user', 'postComments')
            ->whereHas('subCategories', function($query) use ($sub_category) {
            $query->where('sub_category', $sub_category);
            })->get();

        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();

        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();

        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }


    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    // post
    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }


    // 投稿用の処理
    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        // $post→モデルのメソッド名→変数request→name名
        $post->subCategories()->attach($request->post_category_id);
        // 'sub_category_id'=> $request->post_category_id
        return redirect()->route('post.show');
    }

    //投稿の更新
   public function postEdit(Request $request){
    $validatedData = $request->validate([
        'post_title' => 'required|string|max:100',
        'post_body' => 'required|string|max:5000',
    ], [
        'post_title.required' => 'タイトルは必須です。',
        'post_title.string' => 'タイトルは文字で入力してください。',
        'post_title.max' => 'タイトルは100文字以内で入力してください。',
        'post_body.required' => '本文は必須です。',
        'post_body.string' => '本文は文字で入力してください。',
        'post_body.max' => '本文は5000文字以内で入力してください。',
    ]);

    Post::where('id', $request->post_id)->update([
        'post_title' => $validatedData['post_title'],
        'post' => $validatedData['post_body'],
    ]);

    return redirect()->route('post.detail', ['id' => $request->post_id]);
}


    // 投稿の削除
    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    // メインカテゴリーの作成
    public function mainCategoryCreate(Request $request)
    {
        $validatedData = $request->validate([
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category',
        ], [
            'main_category_name.required' => 'メインカテゴリーは必須です。',
            'main_category_name.string' => 'メインカテゴリーは文字で入力してください。',
            'main_category_name.max' => 'メインカテゴリーは100文字以内で入力してください。',
            'main_category_name.unique' => '同じ名前のメインカテゴリーは登録できません。',
        ]);

        MainCategory::create(['main_category' => $validatedData['main_category_name']]);
        return redirect()->route('post.input');
    }

   // サブカテゴリーの制作
    public function subCategoryCreate(Request $request){
        $validatedData = $request->validate([
        'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        'main_id' => 'required|exists:sub_categories,id',
    ], [
        'main_id.required' => 'メインカテゴリーの選択は必須です。',
        'main_id.exists' => '指定されたメインカテゴリーは存在しません。',
        'sub_category_name.required' => 'サブカテゴリーは必須です。',
        'sub_category_name.string' => 'サブカテゴリーは文字で入力してください。',
        'sub_category_name.max' => 'サブカテゴリーは100文字以内で入力してください。',
        'sub_category_name.unique' => '同じ名前のサブカテゴリーは登録できません。',
    ]);

    SubCategory::create([
        'main_category_id' => $validatedData['main_id'],
        'sub_category' => $validatedData['sub_category_name']
    ]);

    return redirect()->route('post.input');
}

    public function commentCreate(Request $request){
    $validatedData = $request->validate([
        'comment' => 'required|string|max:2500',
    ], [
        'comment.required' => 'コメントは必須です。',
        'comment.string' => 'コメントは文字で入力してください。',
        'comment.max' => 'コメントは2500文字以内で入力してください。',
    ]);

    PostComment::create([
        'post_id' => $request->post_id,
        'user_id' => Auth::id(),
        'comment' => $validatedData['comment']
    ]);
    return redirect()->route('post.detail',['id' => $request->post_id]);
}

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
