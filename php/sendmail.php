<?php
  //メールを送信するための処理
  require_once('securityCodeMessage.php');
  mb_language("uni"); //https://www.php.net/manual/ja/function.mb-language.php
  mb_internal_encoding("UTF-8");
  if (mb_send_mail($_SESSION['loginEMail'], $subject,$message, $from)){
    $msgFlag = "code";
    require_once('../html/secondCode.php');
  }
  else echo $failureMessage;
?>