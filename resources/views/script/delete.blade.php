{{--ボタンが押されたらAjax処理を行ってDB内のモンスターを削除
    その後DOM操作を行い現在の表示からモンスターを削除する--}}
<script type="text/javascript">
  $('button').click(function () {
    let order = $(this).index('button');
    let quest_id = {{ $quest->id }};

      {{--Ajaxを用いてDBからモンスターを削除--}}
    $.post( quest_id + '/' + order + '/destroy', {
      'quest_id': quest_id,
      'order': order,
      '_method': 'DELETE',
      '_token': '{{ csrf_token() }}',
    })
    {{--通信成功後html内の要素も削除--}}
    .done(function () {
      $('tr').eq(order).remove();

      {{--消した後orderがバラバラになるので再設定する（DB内orderはdeleteメソッドで削除済）--}}
      $('#sortable_table').find('[class="order"]').each(function (i) {
        //区切り文字,が必要
        $(this).text(i + ",");
      })
    })
  })
</script>
