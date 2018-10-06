{{--jQueryのsortableを利用して値をデータベースに保存する
ソートしたいテーブルのtbodyのidにsortable_tableに設定すること--}}
<script type="text/javascript">
  $('#sortable_table > tr').css('cursor','move');
  $('#sortable_table > tr').height(100);

  $('#sortable_table').sortable({
    //ドラッグ＆ドロップのときにhelperの高さが変わらないようにする
    placeholder: '#sortable_table > tr',
    forcePlaceholderSize: true,
    tolerance: 'pointer',
    update: function () {
      //並び替えられた順にorderを引っ張ってきて配列を作る
      let orders = $(this).find('[class="order"]').text();
      let separator = ',';
      let array_orders = orders.split(separator);
      array_orders.pop();

      //Ajax処理。データベースにorderを保存する
      $.post('save_monster_order', {
        'array_orders[]': array_orders,
        'quest_id': {{ $quest->id }},
        //CSRF対策
        '_token': '{{ csrf_token() }}',
      })

      {{--データベース保存が終わってからorderセルの番号を書き直す。これをやっておかないと再度並べ替えたとき順番がめちゃくちゃになる--}}
      .always(function () {
        $('#sortable_table').find('[class="order"]').each(function (i) {
          //区切り文字,が必要
          $(this).text(i + ",");
        })
      })
    }
  })

  $('#sortable_table').disableSelection();
</script>
