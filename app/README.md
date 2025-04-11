# app
APP 簡単な・・・するツール


### PATを使ったGitHubリポジトリのクローン手順：

1. **GitHubでPersonal Access Token (PAT)を作成する：**
   - GitHubアカウントにアクセスし、**Settings**に移動します。
   - **Developer Settings**セクションで、**Personal access tokens**を選択します。
   - **Tokens-classic**をクリックします。
   - **Generate new token**をクリックし、トークンに必要な権限を設定します。特に必要がなければ、通常はデフォルトのままで構いません。
   - トークンが作成されたら、**コピー**します。次のステップでこれをパスワードとして使用します。

2. **リポジトリをクローンする：**
   - ターミナルを開き、次のコマンドを実行してリポジトリをクローンします。
     ```bash
     git clone https://github.com/ridgeHari/app.git
     ```
   
3. **認証プロセス：**
   - **username**の入力を求められたら、**GitHubアカウントのメールアドレス**を入力します。
   - **password**の入力を求められたら、先ほど作成した**Personal Access Token (PAT)**を貼り付けます。


## ローカルDocker環境での環境構築実行手順

この手順では、Docker Composeを使用してローカル環境でアプリケーションを実行する方法を説明します。

1. **各リポジトリに.envファイルを配置する:**
   - app(アプリケーション側)はsrcフォルダ内
   - container(docker側)は直下
   
   上記の`.env.example`ファイルをそのままコピー＆ペーストし、その名前を`.env`にしてください

   `.env`の中身の記載は別途手順書の記載を参考にしてください。

2. **containerへ移動:**
   ```bash
   cd container
   ```
   - コンソールで`container`ディレクトリを開きます。

3. **Dockerコンテナの起動とビルド:**
   ```bash
   docker-compose up -d
   ```
   このコマンドは、Docker Composeファイル（例：`docker-compose.yml`）に基づいてコンテナを起動し、必要なイメージをビルドします。`-d`オプションは、コンテナをデタッチモード（バックグラウンド）で実行します。

4. **Makeコマンドによる実行環境の一括設定:**
   ```bash
   make init
   ```
   このコマンドは、`Makefile`内に記載された、`docker-compose`コマンドを一括で実行し、環境を構築します。makeコマンドが実行出来ない場合、Linuxにmakeコマンドをinstallしてください。

5. **アプリケーションへのアクセス:**
   - http://localhost:8080/
   
   Webブラウザを開き、上記のURLにアクセスします。アプリケーションが正常に起動していれば、ページが表示されます。

## ローカルDocker環境での環境実行手順（環境構築後）

1. **containerへ移動:**
   ```bash
   cd container
   ```
   - コンソールで`container`ディレクトリを開きます。

2. **docker起動:**
   - dockerの各コンテナを起動します。
     ```bash
     docker-compose exec app npm run dev
     ```
3. **コンテナ内での開発サーバー起動:**
   - どちらかを実行してください、makeコマンドの方は念の為キャッシュを削除するコマンドも同時に実行します。
   - `app`コンテナ内で開発サーバーを起動します。
     ```bash
     docker-compose exec app npm run dev
     ```
     ```bash
     make start
     ```