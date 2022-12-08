<!----------------------------------------------------------------------------------------------------------------------------------------------
check.php
------------------------------------------------------------------------------------------------------------------------------------------------
Save the check or uncheck state into the database 
----------------------------------------------------------------------------------------------------------------------------------------------->

<!-- CHECK TEST ALERT  -->
<?php

if(isset($_POST['id'])){
    require '../db_connect.php';

    $id = $_POST['id'];     //pass the id value 

    if(empty($id)){
        echo "error";       //output error if empty 
    }else{
        $todos = $conn-> prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];
        $uChecked = $checked ? 0 : 1;   //if checked makes it unchecked, vice versa
        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $checked;      //outputt checked if success
        }else{
            echo "error";
        }

        $conn = null;
        exit();     //terminate the execution 
    }
}else{
    header("Location: ../index.php?mess=error");
}