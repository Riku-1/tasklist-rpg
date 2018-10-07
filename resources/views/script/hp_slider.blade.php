<script>
  $(function(){
    $('tr').each(function (i) {
      let hp = $('[id=hp_slider]').eq(i).val();
      let monster_num = i;

      changeMonsterDisplay(hp, monster_num);
    })
  });

  $('[id=hp_slider]').change(function () {
    var hp = $(this).val();
    var monster_num = $('[id=hp_slider]').index(this);

    changeMonsterDisplay(hp, monster_num);

    {{--labelの書き換え--}}
    $(this).prev().text(hp + "/100")

    {{--AjaxでデータをDBに保存--}}
    $.post('save_hp', {
      'quest_id': {{ $quest->id }},
      'hp' : hp,
      'monster_num': monster_num,
      //CSRF対策
      '_token': '{{ csrf_token() }}',
    })

  })

  /**
   * モンスターが死んでいるか生きているかで表示を変更する
   * @param
   * int hp
   * int monster_num: 何番目の要素が操作されているか
   */
  function changeMonsterDisplay(hp, monster_num) {
    if (hp == 0) {
      $('[id=monster_img]').eq(monster_num).css('filter', 'sepia(95%)');
      {{--カラムタイトル分trは一つ多くなる--}}
      $('tr').eq(monster_num + 1).addClass('danger');
    }
    else {
      $('[id=monster_img]').eq(monster_num).css('filter', 'sepia(0%)');
      $('tr').eq(monster_num + 1).removeClass('danger');
    }
  }
</script>
