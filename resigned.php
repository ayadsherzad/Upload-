<?php
session_start();

   
if( !isset($_SESSION["user"]) ){
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> dashborad</title>
    <meta name="language" content="English">    

  </head>
  <body>
      

<style>
*{color:#fff;
    margin:0;
    padding:0;
    font-family:system-ui;

}
body {background:#111;}

.top {
    width:100%;
    height:60px;
    background-color:#282828;
    color:#fff;
}
.top h1 {
    padding:7.5px;
}
.apptitle{
    margin:20px 0;
    font-weight:900;
}
img{
    width:40px;
    border-radius:10px;
    border:2px #ffe400 solid;
}
.app {
     width:100%;
    height:60px;
    background:#120120;
outline-style: solid;
  outline-color: #fff;

}
.btns {
    display:inline-block;
    float:right;
    margin:15px 7.5px;
    
}
.btn {
    width:50px;
    height:30px;
    background:none;
    border-radius:5px;
    text-decoration: none;
}

.hrefbtn {
    padding:10px;
    border:2px #fff solid;
}

.delete{
    color:red;
    border:#f00 2px solid;
    
}
.resign {
    color:#0f0;
    border:2px #0f0 solid;
}
.appimg {
    float:left;
    margin:7.5px 5px;
}
.appname{
    float:left;
    margin:5px;
}
</style>
  <div class="top"><h1>dashboard</h1></div>
  
  <br>
  <a class="hrefbtn btn" href="uploads.php" >Add</a>
  </div>
  
  <div class="apptitle">
     <p>resigned apps</p>
  </div>


<?php 
$fileList = glob('json/*.json');
$fileCount = count($fileList) ;


print_r("
    <div class='applications'>
    Total Apps : " . $fileCount);
for ($i = 0; $i <= $fileCount-1 ; $i++) {
    
$djson = file_get_contents($fileList[$i]);
$hf = $fileList[$i] ;
 $data = json_decode($djson, true);

$im = $data['img'];
$n = $data['name'];
  print_r('
    <div class="app"><div class="appimg"><img src="'.$im.'"></div><div class="appname"><p>'.$n.'</p></div>  <div class="btns"><button class="delete btn" value="'.$hf.'" >delete</button> </div></div>
    
<br>') ;


}


?>

</div>

<script>

var dele = document.querySelectorAll('.delete');
dele.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var de = this.value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            }
        };

        xhr.open('GET', 'https://github.com/ayadsherzad/Upload-/upload/delete.php?delete='+de, true);
        xhr.send();
    });
});
</script>


 
</body>
</html>