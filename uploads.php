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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
      

<style>
*{color:#fff;
    margin:0;
    padding:0;
    font-family:system-ui;

}
 #progress-container {
    width: 100%;
    height: 25px;
    background-color: #f1f1f1;
    color:#000;
    border-radius: 5px;
    margin-top: 10px;
  }

  #progress-bar {
    height: 100%;
    background-color: #4caf50;
    color:#000;
    border-radius: 5px;
    width: 0%;
  }
input{
    color:#000;
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
.hrefbtn{
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
    height:40px;
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
  <a class="hrefbtn btn" href="resigned.php" >Apps</a>
  </div>
 



</center>
<form id="upload-form" enctype="multipart/form-data">
  <div class="form">
    <div class="col-7">
      <input id="name" type="text" class="form-control" placeholder="Name" value="" required name="name" />
    </div><br>
    <input type="text" class="form-control" style="display:none;" id="iconn" placeholder="Img Link" value="" name="img" />
    <div class="col-7">
      <input type="text" class="form-control" id="version" placeholder="Version" value="" name="Version" />
    </div><br>
    <div class="col-7">
      <input type="text" class="form-control" id="bundle" placeholder="Bundle" value="" name="bundle" />
    </div><br>
  

 <div id="progress-container" style="display: none;">
      <div id="progress-bar" style="width: 0;"></div>
    </div>

    <div id="result-list"></div>

    <input class="px-2 py-1 bg-white mb-4 text-gray-600 dark:text-gray-400 shadow-md dark:bg-gray-800 border" style="width:300px; display:<?php echo $hide; ?>;" onchange="fileSelect()" type="file" name="file" accept="" id="file-input" required>

   
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-primary" type="button" name="add" onclick="uploadFile()">Add</button>
  </div>
</form>

<script>
  
   


function uploadFile() {
    
     var name = document.getElementById("name").value;
    var bundle = document.getElementById("bundle").value;
    var version = document.getElementById("version").value;
    var icon = document.getElementById("iconn").value;
   
   
    const form = document.getElementById('upload-form');
    const fileInput = document.getElementById('file-input');
    const file = fileInput.files[0];
    if (!file) {
      return;
    }

    const progressBar = document.getElementById('progress-bar');
    const progressContainer = document.getElementById('progress-container');
    progressBar.style.width = '0%';
    progressContainer.style.display = 'block';


    const formData = new FormData(form);
    formData.append('file', file);
    formData.append("icon", icon); 
    formData.append("version", version); 
    formData.append("bundle", bundle); 
    formData.append("name", name); 

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php', true);

    xhr.upload.addEventListener('progress', function (e) {
      const progress = (e.loaded / e.total) * 100;
      progressBar.style.width = progress + '%';

    });

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Upload completed successfully
        // Handle response from the server
        console.log(xhr.responseText);
    progressContainer.style.display = 'none';

      }
    };

    xhr.send(formData);
  }

</script>


<script src="./dist/app-info-parser.js"></script>
<script>
function fileSelect() {
const files = document.getElementById('file-input').files
try {
const parser = new AppInfoParser(files[0])
parser.parse().then(result => {
document.getElementById("name").value = result['package'] || result['CFBundleName'];
document.getElementById("iconn").value = result.icon;
document.getElementById("version").value = result['versionName'] || result['CFBundleShortVersionString'];
document.getElementById("bundle").value = result['package'] || result['CFBundleIdentifier'];


}).catch(e => {
window.alert('Parse Error: ' + e)
})
} catch (e) {
window.alert('Parse Error: ' + e)
}
}
</script>

  </body>
</html>
