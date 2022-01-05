<span id="register" data-title="Register Page">
    Register Page<br>
    <form method="POST" action="../php/twoFactorAuthAjax.php">
      ユーザ名：<input id="registerEMail" type="text" name="registerEMail">
      <br>
      パスワード：<input id="registerPass" type="password" name="registerPass">
      <br>
      再確認パスワード：<input id="registerPass2nd" type="password" name="registerPass2nd">
      <input id="towFactorPass" type="submit" name="towFactorPass" value="新規登録">
      <br>
    </form>
    <script type="text/javascript" src="../js/twoFactorAuthAjax.js" async="async"></script>
</span>