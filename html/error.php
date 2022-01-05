<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>twoFactorAuthAjax</title>
    <link type="text/css" rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <div id="content">
    <form method="POST" action="../php/twoFactorAuthAjax.php">
      <input id="reload" type="submit" name="reload" value="戻る">
      <br>
    </form>
        <div id="error">
            <?php
            for($i=0 ; $i < count($msgError) ; $i++){
            if($i == $msgFlag){
                echo $msgError[$i];
                echo "<br>最初からやり直してください";
            }
            }
            ?>
        </div>
    </div>
    <script type="text/javascript" src="../js/twoFactorAuthAjax.js" async="async"></script>
  </body>
</html>