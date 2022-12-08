<?php
require 'db_connect.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>TO DO LIST</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif|Roboto:300" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">

        <!------------------------------------------HEADER------------------------------------------>
        <header>
            <h1> TO DO LIST </h1>
        </header>

        <!------------------------------------------FORM------------------------------------------>
        <form action="app/add.php" class="todo-form" method="POST" autocomplete="off">
            <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                <!-- Form input validation-->
                <input name="title" type="text" style="border:2px solid red" class="todo-input" placeholder="This field is required, please try again ">
                <button type="submit" class="add-button">ADD</button>
            <?php } else{ ?>
                <input type="text" name="title" class="todo-input" placeholder="Type something here...">
                <button type="submit" class="add-button">ADD</button>
            <?php } ?>
        </form>


        <?php
            $todos = $conn -> query("SELECT * FROM todos ORDER BY id DESC");
        ?>

        <!------------------------------------------LIST------------------------------------------>
        <ul class="todo-items">
            <?php if($todos->rowCount() <= 0){ ?>
                <li class="item" data-key="7239439364624"></li>
            <?php } ?>
            
            <!-- fetch data from server database -->
            <?php while($todo = $todos-> fetch(PDO::FETCH_ASSOC)) { ?>
            <li class="item" data-key="7239439364624">
                <span id="<?php echo $todo['id']; ?>" class="delete-button fa-sharp fa-solid fa-trash"></span>
                <?php if($todo['checked']){ ?>
                    <input type="checkbox" class="checkbox" data-todo-id = "<?php echo $todo['id']; ?>" checked />
                    <p class="checked"><?php echo $todo['title'] ?></p>
                <?php }else{ ?>
                    <input type="checkbox" class="checkbox" data-todo-id="<?php echo $todo['id']; ?>" />
                    <p><?php echo $todo['title'] ?></p>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>

    </div>

    <!-- <script type="text/javascript" src="js/todolist.js"></script> -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script>

        //delete button click event triggers deletion
        $(document).ready(function(){
            $('.delete-button').click(function(){
                const id = $(this).attr('id');
                // alert(id);

                $.post("app/remove.php",    //call the remove.php to handle the deletion
                    {
                        id:id
                    },
                    (data) => {
                        // alert(data);

                        if(data){
                            $(this).parent().hide(600);
                        }
                    }
                );
            });

            //checkbox click triggers check or uncheck operation 
            $(".checkbox").click(function(e){
                const id = $(this).attr('data-todo-id');
                // alert(id);

                $.post('app/check.php',
                {
                    id: id
                },
                (data) => {
                    // alert(data);
                    if(data != 'error'){
                        const p = $(this).next();
                        if(data === '1'){
                            p.addClass('checked');
                        }else{
                            p.removeClass('checked');
                        }
                    }
                });

            })

        });
    </script>
</body>

</html>