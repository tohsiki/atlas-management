// ユーザー検索
$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();

     $(this).find('.menu-trigger').toggleClass('active');
  });


  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
    $(this).find('.subject-trigger').toggleClass('active');
  });
});





// 投稿のサブカテゴリー検索
$(function () {
  $('.category_conditions').click(function () {
    $(this).next('.category_conditions_inner').slideToggle();

    $(this).find('.menu-trigger').toggleClass('active'); // Toggle active class only on the clicked menu-trigger
  });
});
