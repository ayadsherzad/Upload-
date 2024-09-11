<?php

if (!empty($_POST)) {


$file = $_FILES['file'];
$file_size = $_FILES['file']['size'];
$fileType = $_POST['fileType'];
$icon = $_POST['icon'];
$version = $_POST['Version'];
$bundle = $_POST['bundle'];
$appName = $_POST['name'];
$ann = uniqid();

$tmp = $file['tmp_name'];
 


$file_destination = 'uploads/' . "$ann.ipa";

move_uploaded_file($tmp , $file_destination);


   if ($file_size > 1024000000) {
        $file_size = $file_size / 1024 / 1024 / 1024 ;
        $ipa_size = round($file_size , 2) .' GB';
    }
    elseif ($file_size > 1024000) {
        $file_size = $file_size / 1024 / 1024 ;
        $ipa_size = round($file_size , 2) .' MB';
    }
    elseif( $file_size > 1024 ){
        $file_size = $file_size / 1024 ;
        $ipa_size = round($file_size , 2) .' KB';
    } 
    elseif( $file_size < 1024 ){
        $ipa_size = $file_size .' bytes';
        
    }

   
$imguploads = 'img/'.$ann.'.png';




if (!copy($icon, $imguploads)) {

    echo "Image copy failed.";
}


$fileLink = 'https://github.com/ayadsherzad/Upload-/upload/' . $file_destination ;
$imgLink = 'https://github.com/ayadsherzad/Upload-/upload/' . $imguploads ;





$path = 'json/'.$ann.'.json';

$jsonData = [
    
        "img" =>  $imgLink,
        "ipa" =>  $fileLink,
        "bundle" =>  (string) $bundle ,
        "version" => (string) $version,
        "size" => $ipa_size,
        "name"=> (string) $appName,
        "plist" => "https://github.com/ayadsherzad/Upload-/upload/plist/$ann.plist",

        
    
];

$jsonString = json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
$fp = fopen($path, 'w');
fwrite($fp, $jsonString);
fclose($fp);

$text = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>items</key>
	<array>
		<dict>
			<key>assets</key>
			<array>
				<dict>
					<key>kind</key>
					<string>software-package</string>
					<key>url</key>
					<string>'.$fileLink.'</string>
				</dict>
				<dict>
					<key>kind</key>
					<string>full-size-image</string>
					<key>needs-shine</key>
					<true/>
					<key>url</key>
					<string>'.$imgLink.'</string>
				</dict>
				<dict>
					<key>kind</key>
					<string>display-image</string>
					<key>needs-shine</key>
					<true/>
					<key>url</key>
					<string>'.$imgLink.'</string>
				</dict>
			</array>
			<key>metadata</key>
			<dict>
				<key>bundle-identifier</key>
				<string>'.$bundle.'</string>
				<key>bundle-version</key>
				<string>'.$version.'</string>
				<key>kind</key>
				<string>software</string>
				<key>subtitle</key>
				<string>'.$appName.'</string>
				<key>title</key>
				<string>'.$appName.'</string>
			</dict>
		</dict>
	</array>
</dict>
</plist>
' ;
$plistname = "plist/$ann.plist";
$fh = fopen($plistname, "a");
fwrite($fh, $text);
fclose($fh);

$curl = curl_init();

$data = array(
    'name' => $appName,
    'bundle' => $bundle,
    'version' =>  $version,
    'img' => $imgLink,
    'size' => $ipa_size,


  );

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://github.com/ayadsherzad/Upload-/upload/tme.php",
  CURLOPT_CUSTOMREQUEST => "POST", 
  CURLOPT_RETURNTRANSFER=> true,
  CURLOPT_POSTFIELDS => $data ,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: multipart/form-data;',
    'Connection: keep-alive',
   ),
));
  



    



$response = curl_exec($curl);

if(curl_errno($curl)) {
    echo 'Curl error: ' . curl_error($curl);
}

curl_close($curl);

 

echo "done";
    } else {
      echo 'Failed to move file to destination folder';
    }
    
    
 

?>
