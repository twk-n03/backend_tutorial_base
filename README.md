# Partsone バックエンド研修課題リポジトリ

- APIの実装
    - Seederの実装,応用課題未実施
    - index/store/update/destroyを追加
    - userIdは仮実装で、query parameterで受け取る仕様です
- 注意して見てほしい点
    - Controller内の関数で引数が適切かどうか（特にuser_idの扱いがよくわからず難しかったので）
- 得た学び
    - Modelやmigrationなど各ファイルの役割やDBとのつながりを少し理解できた。
    - ymlファイルなど設計者側ではカラムの名前はcommentIdなどの表記(キャメルケース)で、DB側ではcomment_idのような表記(スネークケース)がされる。

- DBをmysqlコンテナで確認する方法がわかった。
- DBとModelsでの定義を一致させる必要がある。特に、デフォルトでは各テーブルにidが主キーとなっているため、基本的にはそのまま使う。他のテーブルのidをカラムとして追加するとき（外部キー）にarticle_idなどの名前が使われるだけで、articlesテーブルではidというカラムである。
- Modelsでリレーションを定義するときは、キーを参照されている側（親）と外部キーを持っている側（子）の関係を正しく書く。親側からはhasManyやhasOne,子側からはbelongsToという定義になる。1対1や1対多を双方向的に定義するのではなく、親子関係を定義し、親側で1対1なのか1対多なのかを示すというイメージ。

- migrationファイルの中で外部キー制約を付けるには、foreignId('XXX_id')->constrained()で、id名から自動的に参照先テーブルを推測してそのテーブルのidカラムに存在する整数(unsignedBigInteger)のみを許可する。さらに、->cascadeOnDelete()で、親レコードが削除されたら子レコードも削除されるように設定できる。
- migrationはファイル名の順すなわちファイルを作成した順に実行されるが、参照先である親テーブルが子テーブルよりも先に作成されないとエラーになる。migrationファイル作成時にcommentsテーブルから先に作ってしまったため、今回はcommentsテーブルのmigrationファイル名の日付部分を調整することでarticles->commentsの順になるように修正した。