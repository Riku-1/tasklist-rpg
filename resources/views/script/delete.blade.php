<script type="text/javascript">
  $('button').click(function () {
    let order = $(this).index('button');
    let quest_id = {{ $quest->id }};

    $.post( quest_id + '/' + order + '/destroy', {
      'quest_id': quest_id,
      'order': order,
      '_method': 'DELETE',
      '_token': '{{ csrf_token() }}',
    })
    .done(function () {
      $('tr').eq(order).remove();

      {{--消した後orderがバラバラになるので再設定する--}}
      $('#sortable_table').find('[class="order"]').each(function (i) {
        //区切り文字,が必要
        $(this).text(i + ",");
      })
    })
  })
</script>
