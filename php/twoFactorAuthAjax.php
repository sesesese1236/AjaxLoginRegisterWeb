<?php
//   require_once('destroy.php');
session_start();
    $msgFlag = -1;
    $msgError = [
        'メールアドレスが存在しません。'
        ,'パスワードが間違っています。'
        ,'メールアドレスが存在しました別のメールで登録してください。'
        ,'パスワードが一致していません。'
        ,'認証コードの有効期限が切れました。'
        ,'セキュリティコードコードが違います。'
        ,'新規登録できました'
    ];
  if(!$_POST){
      require_once('../html/twoFactorAuthAjax.php');
  }
  else if(isset($_POST['loginEMail']) 
  && isset($_POST['loginPass'])){
    $mysqli = new mysqli('localhost','root','','2021DB');
    $sql = "select * from user where eMail = '{$_POST['loginEMail']}'";
    $result = $mysqli -> query($sql);
    if($result -> num_rows == 1){
      $row = $result -> fetch_assoc();
      $_SESSION['loginEMail'] = $row['eMail'];
      $sql = "select * from user where eMail = '{$_SESSION['loginEMail']}' and pass = '{$_POST['loginPass']}';";
        $result = $mysqli -> query($sql);
        if($result -> num_rows == 1){
            $row = $result -> fetch_assoc();
            //セキュリティコードコードの発行(乱数を使って発行) 
            $randStr = "";
            for($i = 0 ; $i < 8 ; $i++){
            $randStr .= mt_rand(0,9);
            }
            $sql = "update user set authCode = '{$randStr}' where eMail = '{$_SESSION['loginEMail']}';";
            $result = $mysqli -> query($sql);
            require_once('sendmail.php');
        }
        else{
            $msgFlag = 1;
            require_once('../html/error.php');
        }
    }
    else{
        $msgFlag = 0;
        require_once('../html/error.php');
    }
    
    
    $mysqli ->close();
  }
  elseif(isset($_POST['registerEMail']) 
  && isset($_POST['registerPass'])
  && isset($_POST['registerPass2nd'])){
    $mysqli = new mysqli('localhost','root','','2021DB');
    $sql = "select * from user where eMail = '{$_POST['registerEMail']}'";
    $result = $mysqli -> query($sql);
    if($result -> num_rows == 0){
      $_SESSION['registerEMail'] = $_POST['registerEMail'];
        
        if($_POST['registerPass'] == $_POST['registerPass2nd']){
            $_SESSION['registerPass'] = $_POST['registerPass'];
            $registerEmail = $_SESSION['registerEMail'];
            $registerPass = $_SESSION['registerPass'];
            $sql = "insert into user(eMail,pass) values ('{$registerEmail}','{$registerPass}');";
            $result = $mysqli -> query($sql);
            $msgFlag = 6;
            require_once('../html/error.php');
        }
        else{
            $msgFlag = 3;
            require_once('../html/error.php');
        }
    }
    else{
        $msgFlag = 2;
        require_once('../html/error.php');
    }
    $mysqli ->close();
  }
  else if(isset($_POST['code'])){
    $mysqli = new mysqli('localhost','root','','2021DB');
    $sql ="select * from user where authCode = '{$_POST['code']}';";
    $result = $mysqli -> query($sql);
    if($result -> num_rows == 1){
      $row = $result -> fetch_assoc();
      date_default_timezone_set('Asia/Tokyo');
      $elapsedTime = strtotime(date('Y-m-d H:i:s')) - strtotime($row['timeStamp']);
      if($elapsedTime > 120){
        $sql = "update user set authCode = NULL where eMail = '{$_SESSION['loginEMail']}';";
        $mysqli -> query($sql);
        $mysqli -> close();
        $msgFlag = 4;
        require_once('../html/error.php');
      }
      else{
        $sql = "update user set authCode = NULL where eMail = '{$_SESSION['loginEMail']}';";
        $mysqli -> query($sql);
        echo "Hello {$_SESSION['loginEMail']}";
      }
      
    }
    else{
        $msgFlag = 5;
        require_once('../html/error.php');
    }
  }
  else if($_POST['reload']){
    header('Location: twoFactorAuthAjax.php');
  }
?>
