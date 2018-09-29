<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Others

はじめは「Dream Come True RPG」という名前のアプリだったが、ご褒美設定があるこの方式だと外発的動機付けになるのでやめた。

好きなことを頑張るための報酬は、やりがいそれ自体であってご褒美という形で外に理由を作るのはあまり好ましくない。

そのためアプリの名前は「Tasklist RPG」に変えた。中身は変わっていないが、嫌なことを頑張るためのアプリということに。

## Todo List
- **並び替えはできたので値を取得でorderに入れる**
- **横並びは素材用意するのに時間かかりそうやから縦に並べる。進行度バーつけてその上に勇者画像置こう**
- **次はボス表示（quests/{$id}）を作成。道中とか作成**
- **報酬削除のときにクエストに使われている報酬の場合は削除できないように**
- **ボス設定機能**
- **ザコ敵設定機能**
- **アイテムや報酬設定にソート機能をつける**
- **検索機能もつける（後回し）**
- **エラーページをちゃんと作る。バリデーションも**
- **一時的な報酬を追加できるようにする。継続的じゃない報酬**
- **モンスター読み込みのときorderが正常であるか（重複していないか）チェックしてから表示しよう。重複している場合は順番リセット**
- **モンスタークラスからボスクラスとザコ敵クラス作る**
- **コンストラクタでユーザーが生成されたときに初期値を設定する**
- **ボス報酬をクエスト報酬としてクエスト一覧画面に表示**

## アイデアとか


##Study
- **.mdの書き方**
- **laravel - techacademyで基礎を勉強。その後詳しいことは作りながらドキュメントなどを見た**
- **jquery - vue.jsやtypescriptを使う方法もあったが、早く公開できるものを作りたかったためコスト面から選択**
- **bootstrap - ドキュメントを見るだけで簡単に部品が作れて便利。次は別のcssライブラリとか、もしくはsassを勉強してみたい**
