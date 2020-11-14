<?php
    spl_autoload_register(
        function($class){
            require_once "model/$class.php";
        }
    );
    session_start();

    // var_dump($_GET["email"]);
    // var_dump($password = $_GET["password"]);
    // var_dump($_GET["first"]);
    // var_dump($_GET["last"]);
    // var_dump($_GET["country"]);

    $userid = $_GET["userid"];
    $email = $_GET["email"];
    $password = $_GET["password"];
    $first = $_GET["first"];
    $last = $_GET["last"];
    if ($_GET["country"] == "Country (Optional)") {
        $country = '';
    }
    else {
        $country = $_GET["country"];
    }
    // var_dump($country);

    // $email = "emflwk@gmail.com";
    // $password = "emflwk";
    // $first = 'Elvis';
    // $last = 'Leong';
    // $country = 'Iowa';

    $dao = new UserDAO();
    // $success = false;

    if ($dao->retrieve($email)) {
        $_SESSION["existingemail"] = true;
        header("Location: ../signup.php");
    }

    if ($dao->retrieveUserId($userid)) {
        $_SESSION["existingUserId"] = true;
        header("Location: ../signup.php");
    }

    if (!$dao->retrieve($email) && !$dao->retrieveUserId($userid)) {
        // $count = $dao->generateUserId();
        $user = $dao->register($userid, $email, $password, $first, $last, $country);
        if ($user) {
            header("Location: ../success.html");
        }
    }
?>
