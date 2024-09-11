<?php
if (isset($_GET['delete'])) {
    
    $delete = $_GET['delete'];



unlink($delete);






}

?>