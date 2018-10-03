<script>
    $('[id=hp_slider]').change(function () {

      {{--labelの書き換え--}}
      var hp = $(this).val();
      $(this).prev().text(hp + "/100")

      {{--AjaxでデータをDBに保存--}}
      $.post('save_hp', {
        'quest_id': {{ $quest->id }},
        'hp' : hp,
        'monster_num':  $('[id=hp_slider]').index(this),
        //CSRF対策
        '_token': '{{ csrf_token() }}',
      })

    })
</script>
