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

  // 申し込みボタン押下時の処理
  $(document).on('click','.order',function() {
    $('.order-modal').animate({
      top: '0'
    },200);
    $('.order-modal-wrap').animate({
      top: '0'
    },200);

    $dateText = $(this).parents('tr').find('.date').text();
    $timeText = $(this).parents('tr').find('.time').text();
    $nameText = $(this).parents('tr').find('.name').text();
    $amountText = $(this).parents('tr').find('.amount').text();
    $placeText = $(this).parents('tr').find('.place').text();
    $remainText = $(this).parents('tr').find('.remain').text();
    $id = $(this).parents('tr').find('.seminar-id').val();
    
    $('.order-modal-wrap .order-id').val($id);
    $('.order-modal-wrap .seminar-name span').text($nameText);
    $('.order-modal-wrap .seminar-date span').text($dateText);
    $('.order-modal-wrap .seminar-time span').text($timeText);
    $('.order-modal-wrap .seminar-amount span').text($amountText);
    $('.order-modal-wrap .seminar-place span').text($placeText);
    $('.order-modal-wrap .seminar-remain span').text($remainText);

  });

  // 申し込みモーダル非表示
  $(document).on('click','.order-modal-content-wrap .close',function() {
    $('.order-modal').animate({
      top: '-100%'
    },200);
    $('.order-modal-wrap').animate({
      top: '-100%'
    },200);
  });

  // 申し込みキャンセル
  $(document).on('click','.seminar-cancel-btn',function() {
    $id = $(this).parents('tr').find('.seminar-id').val();
    $('.seminar-cancel').val($id);
  });


  // 検討リストボタン押下時
  $(document).on('click','.consider-btn',function() {
    $(this).removeClass('btn-primary')
           .addClass('btn-dark')
           .css('opacity',0.4)
           .text('検討追加済み');

    var seminar_id = $(this).parents('tr').find('.seminar-id').val();
    var user_id = $('.login-id').val();
    
    $.ajax({
      type: 'post',
      url: '/insource/considerations/store',
      data: {
        'seminar_id': seminar_id,
        'user_id': user_id
      },
      dataType: 'text'
    }).done(function(response) {
      console.log(response);
    }).fail(function(response) {
      console.log(response);
    });
  });

});