<?php
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );

    session_start();
    unset($SESSION['check']);
    $email = $_GET["email"];
    $password = $_GET["password"];
    if ($password == "" and (!isset($_GET['google']))) {
        $_SESSION["nopassword"] = true;
        header("Location: ../login.php");
    }
    var_dump(isset($_GET['google']));
    if (isset($_GET['google'])) {
        $google = $_GET['google'];
    }
    $dao = new UserDAO();
    $user = $dao->retrieve($email);
    // $success = false;
    if(($user != null) && ($user->getHashedPassword() == $password)){
        // $hashed = $user->getHashedPassword();
        // $success = password_verify($password,$hashed); 
        // if () {
        // if($success){
            var_dump($user->getUserId());
            $_SESSION["userid"] = $user->getUserId();
            // $_SESSION["fullname"] = 
            $_SESSION["email"] = $email;
            $_SESSION["check"] = true;
            // var_dump('test');
            header("Location: ../index.php");
            var_dump($_SESSION["email"]);
        // }
    }
    
    elseif (isset($google)) {
        // var_dump($google);
        $_SESSION["email"] = $email;
        $_SESSION["check"] = true;
        $dao = new UserDAO();
        // $count = $dao->generateUserId();
        $_SESSION["userid"] = $email;
        $user = $dao->retrieve($email);
        if ($user) {
            $_SESSION["userid"] = $user->getUserId();
            header("Location: ../index.php");
        }
        else {
            $user = $dao->register($email, $email, "", $_GET["first"], $_GET["last"], "");
            header("Location: ../index.php");
            // var_dump('test');
        }
    }

    elseif ($password != "") {
        $_SESSION["check"] = false;
        // unset($_SESSION['email']);
        header("Location: ../login.php");
        // var_dump($user);
    }
?>
