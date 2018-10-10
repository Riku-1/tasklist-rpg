<script>
  $(function(){
    $('tr').each(function (i) {
      let hp = $('[id=hp_slider]').eq(i).val();
      let monster_num = i;

      setIsAlive(hp, monster_num);
      setMonsterDisplay(hp, monster_num);
    })
  });

  $('[id=hp_slider]').change(function () {
    let hp = $(this).val();
    let monster_num = $('[id=hp_slider]').index(this);
    let is_alive = $('.is_alive').eq(monster_num).text();
    setMonsterDisplay(hp, monster_num);

    let change_num_of_ticket = judgeObtainOrLoseTicket(hp, is_alive);
    if (change_num_of_ticket == 1) {
      alert('ガチャチケを獲得しました！')
    }
    else if (change_num_of_ticket == -1) {
      alert('このモンスターから獲得していたガチャチケを回収します');
    }
    else {
    }

    //is_aliveの更新はチケット判定後に行う
    setIsAlive(hp, monster_num);

    {{--labelの書き換え--}}
    $(this).prev().text(hp + "/100")

    {{--AjaxでデータをDBに保存--}}
    $.post('save_hp', {
      'quest_id': {{ $quest->id }},
      'hp' : hp,
      'monster_num': monster_num,
      'change_num_of_ticket': change_num_of_ticket,
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
  function setMonsterDisplay(hp, monster_num) {
    if (hp == 0) {
      $('[id=monster_img]').eq(monster_num).css('filter', 'sepia(95%)');
      {{--カラムタイトル分trは一つ多くなる--}}
      $('tr').eq(monster_num + 1).addClass('danger');
    }
    else {
      $('[id=monster_img]').eq(monster_num).css('filter', 'sepia(0%)');
      {{--カラムタイトル分trは一つ多くなる--}}
      $('tr').eq(monster_num + 1).removeClass('danger');
    }
  }

    /**
   * hpが0ならis_aliveを0,それ以外なら1に書き換える
   * @param
   * int hp
   * int monster_num: 何番目の要素が操作されているか
   */
  function setIsAlive(hp, monster_num) {
    if (hp == 0) {
      $('.is_alive').eq(monster_num).text(0);
    }
    else {
      $('.is_alive').eq(monster_num).text(1);
    }
  }

  /**
   * モンスターの生死をチェックし、それによってチケット変化数を返す
   * 生＝HP0位上、死＝HP0
   * hpで現在の生死状態を判定、is_aliveでhp変化前の生死状態を判定する
   * 生→死ならチケットを獲得(1を返す)。死→生ならチケットを失う(-1を返す)
   * @return int:change_num_of_ticket [description] ガチャチケの変化数
   */
  function judgeObtainOrLoseTicket(hp, is_alive) {
    if (hp == 0) {
      return 1;
    }
    //死(is_alive=0)から生(hp0以外)になったときに-1を返す
    else if(is_alive == 0) {
        return -1;
    }
    else {
      return 0;
    }
  }
</script>
