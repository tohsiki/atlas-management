@extends('layouts.sidebar')
@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view mt-5" style="width:72%;">
    <!-- 投稿を囲っているところ -->
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color:black;">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="sub_category">
           <!-- 投稿にサブカテゴリーの表示 -->
          @foreach($post->subCategories as $sub_category)
            <p><span class="btn-info" style="font-size: 13px; border-radius:5px; padding:4px">{{ $sub_category->sub_category }}</span></p>
          @endforeach
        </div>
        <!-- コメントアイコンといいねボタンを囲ってる。 -->
        <div class="d-flex post_status">
          <!-- コメントアイコン -->
          <div class="mr-5">
            <!-- コメント数のカウントを追記 -->
            <i class="fa fa-comment"></i><span class="">{{ $post->commentCounts($post->id)->count() }}</span>
          </div>
          <!-- いいねボタンの記述 -->
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @else
              <!-- いいね数のカウントを追記 -->
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @endif
          </div>
        <!-- いいねボタンの記述 　ここまで-->

        </div>
      </div>
    </div>
    @endforeach
  </div>


  <div class="other_area" style="margin-right:20px;">
    <div class="m-4" style="margin-top:10px; margin-right:20px;width:90%;">
      <div class="" style="margin-top:50px;margin-bottom:20px; width:100%;">
          <button class="btn btn-info" style="width:100%;border-radius:5px;" onclick="window.location='{{ route('post.input') }}'">投稿</button>
    </div>
      <div class="d-flex">
        <!-- フォームと検索ボタンをくっつける。
       -->
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest" style="background-color: rgba(0, 0, 0, 0.05);outline: none; border: 1px solid #ccc; width: 70%;">
        <div class="search-button" style="width: 30%;">
          <input type="submit" value="検索" form="postSearchRequest" class="btn btn-info" style="width: 100%; ">
        </div>
      </div>

      <!-- いいね投稿と自分の投稿 -->
      <div class="d-flex" style="margin-top:20px; justify-content: space-between;">
        <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest" style="background: #e17397; opacity: 0.75; width: 49%; height:40px;">

        <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest" style="background: #eeb12e; width: 49%; height:40px;">
      </div>
      <div class="" style="margin-top:20px;">
        <p>カテゴリー検索</p>
          <ul>
            @foreach($categories as $category)
            <div class="d-flex category_conditions" style="align-items:center; justify-content: space-between;border-bottom:solid 1px rgba(0, 0, 0, 0.3);">
              <li class="main_categories m-0" category_id="{{ $category->id }}" style="font-size:17px;"><span>{{ $category->main_category }}<span></li>
              <div class="menu-trigger">
                <span></span>
                <span></span>
              </div>
            </div>
          <!-- メインカテゴリーに紐づくサブカテゴリーを表示する -->

            <div class="category_conditions_inner ">
            @foreach($category->subCategories as $sub_category)
                <input type="submit" name="category_word" class="sub_category_btn text-left" value="{{ $sub_category->sub_category }}" form="postSearchRequest" style="display:block;border-bottom:solid 1px rgba(0, 0, 0, 0.3); ">
            @endforeach
            </div>
          @endforeach
        </ul>
      </div>

    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
