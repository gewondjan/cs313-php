<?php
    //Set up the Database connection
    require 'dbConnection.php';
    $db = get_db();

    //Start the session
    session_start();

    //Get the requested action
    $action = $_GET['action'];

    //Functions corresponding to actions
    //-------------------------------------------------------------------
    
    function createAccount() {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $db = get_db();
        echo $db;
        $stmt = $db->prepare('INSERT INTO project.users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();

        //After the user's account has been created, go ahead and sign him in.
        signIn();


    }    
    
    function signIn() {
        $stmt = $db->prepare('SELECT * FROM project.users WHERE email = :email');
        $stmt->bindValue(':email',  $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();
        $returnedUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($_POST['password'], $returnedUser['password'])) {
            //The user's password is correct
            $_SESSION['user_id'] = $returnedUser['id'];
            $_SESSION['user_name'] = $returnedUser['name'];
            header("Location: bucketlist.php");
            die();
        } else {
            echo "The username or password was incorrect!";
            die();
        }
    }




    //Action switch statement
    switch($action) {
        case 'signIn':
            signIn();
            break;

        case 'createAccount':
            createAccount();
            break;

        default:
            echo 'Error: something went wrong. You are in the default case of the action.php switch statement';
            break;
    }

?>