<!----------------------------------------------------------------------------------------------------------------------------------------------
add.php
------------------------------------------------------------------------------------------------------------------------------------------------
Insert new todo submitted from the input into the database 
----------------------------------------------------------------------------------------------------------------------------------------------->

<?php
if(isset($_POST['title'])){         //check for new entry
    require '../db_connect.php';

    $title = $_POST['title'];       //pass the collected form data after submiting the HTML form 

    if(empty($title)){          //Check if the form input is empty 
        header("Location: ../index.php?mess=error");
    }else{
        $stmt = $conn -> prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt-> execute([$title]);

        if ($res){
            header("Location: ../index.php?mess=success");
        }else{
            header("Location: ../index.php");
        }
        $com = null;
        exit();
    }
}else{
    header("Location: ../index.php?mess=error");
}