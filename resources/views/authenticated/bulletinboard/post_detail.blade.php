@extends('layouts.sidebar')
@section('content')
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="p-3">
      <div class="d-flex" style="justify-content: space-between;">
         <div class="sub_category">
           <!-- 投稿にサブカテゴリーの表示 -->
          @foreach($post->subCategories as $sub_category)
            <p><span class="btn-info" style="font-size: 13px; border-radius:5px; padding:4px">{{ $sub_category->sub_category }}</span></p>
          @endforeach
        </div>

        @if(Auth::user()->id == $post->user_id)
          <div class="detail_inner_head">
            <div>
              <span class="edit-modal-open btn btn-danger" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
              <!-- 削除ボタンの形式は確認が必要 -->
              <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-primary" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">削除</a>
            </div>
          </div>
        @endif
      </div>

        <div class="contributor d-flex">
          <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
        @if($errors->has('comment'))
          <span class="error_message">{{ $errors->first('comment') }}</span>
        @endif
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <div class=" text-right">
          <input type="submit" class="btn btn-primary text-right" form="commentRequest" value="投稿">
        </div>
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<!-- 投稿を編集するモーダル -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <!-- バリデーションエラーメッセージを追加する -->
           @if($errors->has('post_title'))
            <span class="error_message">{{ $errors->first('post_title') }}</span>
           @endif
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <!-- バリデーションエラーメッセージを追加する -->
          @if($errors->has('post_body'))
            <span class="error_message">{{ $errors->first('post_body') }}</span>
          @endif
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
