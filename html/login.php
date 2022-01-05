<span id="login" data-title="Login Page">
    Login Page<br>
    <form method="POST" action="../php/twoFactorAuthAjax.php">
      ユーザ名：<input id="loginEMail" type="text" name="loginEMail">
      <br>
      パスワード：<input id="loginPass" type="password" name="loginPass">
      <input id="towFactorPass" type="submit" name="towFactorPass" value="ログイン">
      <br>
    </form>
    <script type="text/javascript" src="../js/twoFactorAuthAjax.js" async="async"></script>
</span>