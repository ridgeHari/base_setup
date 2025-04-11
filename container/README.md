# container
appのコンテナ用


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
     git clone https://github.com/ridgeHari/container.git
     ```
   
3. **認証プロセス：**
   - **username**の入力を求められたら、**GitHubアカウントのメールアドレス**を入力します。
   - **password**の入力を求められたら、先ほど作成した**Personal Access Token (PAT)**を貼り付けます。
