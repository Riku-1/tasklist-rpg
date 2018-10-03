<script type="text/javascript">
  $('#monster_table').sortable({
    //ドラッグ＆ドロップのときにhelperの高さが変わらないようにする
    placeholder: '#monster_table > tr',
    forcePlaceholderSize: true,
    tolerance: 'pointer',
    update: function () {
      //並び替えられた順にorderを引っ張ってきて配列を作る
      var orders = $(this).find('[class="order"]').text();
      var separator = ',';
      var array_orders = orders.split(separator);
      array_orders.pop()

      $.post('save_order', {
        'array_orders[]': array_orders,
        'quest_id': {{ $quest->id }},
        //CSRF対策
        '_token': '{{ csrf_token() }}',
      })

      //データベース保存が終わってからorderセルの番号を書き直す。これをやっておかないと再度並べ替えたとき順番がめちゃくちゃになる
      .always(function () {
        $('#monster_table').find('[class="order"]').each(function (i) {
          //区切り文字,が必要
          $(this).text(i + ",");
        })
      })
    }
  })

  $('#monster_table').disableSelection();
</script>
