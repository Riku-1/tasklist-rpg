<header>
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Tasklist RPG</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
            <li>{!! link_to_route('quests.index', 'クエスト一覧') !!}</li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">各クエスト<span class="caret"></span></a>
              <ul class="dropdown-menu">
                @php
                  $user = Auth::user();
                @endphp
                @foreach ($user->quests as $quest)
                  <li>{{ link_to_route('quests.show', $quest->quest_name, ['id' => $quest->id]) }}</li>
                @endforeach
              </ul>
            </li>
            <li>{!! link_to_route('gacha.main', 'ガチャ') !!}</li>
            <li>{!! link_to_route('owned_items.index', '所持アイテム') !!}</li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">設定<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">My profile</a></li>
                <li>{!! link_to_route('rewards.index', '報酬設定') !!}</li>
                <li role="separator" class="divider"></li>
                <li>{!! link_to_route('logout.get', 'Logout') !!}</li>
              </ul>
            </li>
          @else
            <li>{!! link_to_route('signup.get', 'Signup') !!}</li>
            <li>{!! link_to_route('login', 'Login') !!}</li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
</header>
