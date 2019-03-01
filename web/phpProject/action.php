<?php
    //Set up the Database connection
    require 'dbConnection.php';

    //Start the session
    session_start();

    //Get the requested action
    $action = $_GET['action'];

    //Functions corresponding to actions
    //-------------------------------------------------------------------
    
    function createAccount() {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $db = get_db();
        
        $stmt = $db->prepare('INSERT INTO project.users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();

        //After the user's account has been created, go ahead and sign him in.
        signIn();


    }    
    
    function signIn() {
        $db = get_db();
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

    function updateBucketlistGrid() {
        $cardId = $_GET['cardId'];
        $abcPriority = $_GET['abcPriority'];
        $numberPriority = $_GET['numberPriority'];

        $db = get_db();
        $stmt = $db->prepare('UPDATE project.bucketlist SET primaryPriority = :primaryPriority, secondaryPriority = :secondaryPriority WHERE id = :id');
        $stmt->bindValue(":primaryPriority", $abcPriority, PDO::PARAM_STR);
        $stmt->bindValue(":secondaryPriority", $numberPriority, PDO::PARAM_INT);
        $stmt->bindValue(":id", $cardId, PDO::PARAM_INT);
        $stmt->execute();

        //Could and should put something here to check to see if we were successful in updating the table, but for now, we will
        //just go forward

        header("Location: bucketlist.php");
        die();



    }

    function addNewBucketlistItem() {
        $db = get_db();
        $stmt = $db->prepare('INSERT INTO project.bucketlist (user_id, itemDescription, primaryPriority, secondaryPriority) VALUES (:id, \'New Item\', \'0\', 0)');
        $stmt->bindValue(":id", $_SESSION['user_id'], PDO::PARAM_INT);
        
        // $stmt->bindValue(":primaryPriority", $abcPriority, PDO::PARAM_STR);
        // $stmt->bindValue(":secondaryPriority", $numberPriority, PDO::PARAM_INT);
        $stmt->execute();

        return $db->lastInsertId('project.bucketlist_id_seq');

    }

    function updateBucketlistTitle() {
        $bucketlistId = $_GET['bucketlistId'];
        $newTitle = $_GET['newTitle'];
        
        $db = get_db();
        $stmt = $db->prepare('UPDATE project.bucketlist SET itemDescription = :newDescription WHERE id = :id');
        $stmt->bindValue(":newDescription", $newTitle, PDO::PARAM_STR);
        $stmt->bindValue(":id", $bucketlistId, PDO::PARAM_INT);
        $stmt->execute();

        return $newTitle;
    }


    //Action switch statement
    switch($action) {
        case 'signIn':
            signIn();
            break;

        case 'createAccount':
            createAccount();
            break;

        case 'updateBucketlistGrid':
            updateBucketlistGrid();
            break;
        
        case 'addNewBucketlistItem':
            addNewBucketlistItem();
            break;
        case 'updateBucketlistTitle':
            updateBucketlistTitle();
            break;
        default:
            echo 'Error: something went wrong. You are in the default case of the action.php switch statement';
            break;
    }

?>