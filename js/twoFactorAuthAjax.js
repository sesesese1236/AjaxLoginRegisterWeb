window.addEventListener('load',window_load,false);

function　window_load(){
  var xmlhttp = new XMLHttpRequest();
  arrayHtml = [
    "../html/login.php",
    "../html/register.php",
    "../html/twoFactorAuthAjax.php"
  ];
  arrayTitle = [
    "login",
    "register",
    "twoFactorAuth"
  ];
  number = -1;
  for(var i=0;i<document.getElementsByClassName('btn').length;i++){
    document.getElementsByClassName('btn')[i].onclick=function(e){
      number = e.target.dataset.para;
      loadHTML(e.target.dataset.para);
    }
  }
  function loadHTML(no) {
    xmlhttp.open("GET", arrayHtml[no], true);

    xmlhttp.addEventListener('readystatechange',showHTML,false);

    xmlhttp.send();
  }

  function showHTML() {

    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {

      if(number != 2){
        var down = document.getElementById("down");
  
        down.scrollLeft = 0;
        down.scrollTop  = 0;

        down.innerHTML = xmlhttp.responseText;
      }else{
        
      }
      for(var i = 0 ; i < arrayTitle.length ; i++){
        if(document.getElementById(arrayTitle[i])){
          document.getElementsByTagName('title')[0].innerText = document.getElementById(arrayTitle[i]).dataset.title;
        }
      }
    }
  }
}