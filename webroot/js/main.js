$(function() {
  // datepickerの処理
  $('.datepicker').datepicker();

  // 新規登録モーダル表示
  $(document).on('click','.register',function() {
    $('.register-modal').animate({
      top: '0'
    },200);
    $('.register-modal-wrap').animate({
      top: '0'
    },500);
  });

  // 新規登録モーダル非表示
  $(document).on('click','.register-modal-content-wrap .close',function() {
    $('.register-modal').animate({
      top: '-100%'
    },200);
    $('.register-modal-wrap').animate({
      top: '-100%'
    },200);
  });

  // ログインモーダル表示
  $(document).on('click','.login',function() {
    $('.login-modal').animate({
      top: '0'
    },200);
    $('.login-modal-wrap').animate({
      top: '0'
    },500);
  });

  // ログインモーダル非表示
  $(document).on('click','.login-modal-content-wrap .close',function() {
    $('.login-modal').animate({
      top: '-100%'
    },200);
    $('.login-modal-wrap').animate({
      top: '-100%'
    },200);
  });
});