<!----------------------------------------------------------------------------------------------------------------------------------------------
    remove.php
------------------------------------------------------------------------------------------------------------------------------------------------
Delete new todo submitted from the input into the database 
----------------------------------------------------------------------------------------------------------------------------------------------->


<?php

if(isset($_POST['id'])){        //pass the to-do item for deletion 
    require '../db_connect.php';

    $id = $_POST['id'];         //pass the id 

    if(empty($id)){             //check if the id is empty 
        echo 0;
    }else{
        $stmt = $conn -> prepare("DELETE FROM todos WHERE id=?");
        $res = $stmt-> execute([$id]);

        if ($res){
            echo 1;     //success
        }else{
            echo 0;
        }
        $com = null;
        exit();
    }
}else{
    header("Location: ../index.php?mess=error");
}