<?php 
if(!empty($_POST)){

$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == "B52" && $pass == "admin0123"){
    
    $code == 200 ;
    
    session_start();

    // Set session variables
    $_SESSION['user'] = $user;


    // Create the response array
    $response = array(
        'success' => true,
        'message' => 'login succes',
        'redirect' => "resigned.php"
);
   echo json_encode($response);
} else {
    // Invalid request
    $response = array(
        'success' => false,
        'message' => 'incorrect password or user'
    );

    // Send the response as JSON
    echo json_encode($response);


    
    
}

}



?>
