<?php
    //メール送信に必要なデータメールの用途に場合分けして書きます。
    $subject = "セキュリティコードコードのお知らせ";
    $message = "2分以内に下記のセキュリティコードコードを入力してログインを完了してください。\n".$randStr;;
    $from = "From: 管理者<lacoms@lacoms.net>\r\n";
    $failureMessage = "メール送信に失敗しました。";
  ?>