<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<script>
console.log('hi');
console.log(sessionStorage['userid']);
sessionStorage.clear();
console.log(sessionStorage['userid']);


</script>
    
<?php
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    session_start();
    session_destroy();
    header("Location: ../index.php");
?>




</body>

</html>







