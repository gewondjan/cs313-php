<?php
    
    function get_db()
    {
        $dbPackage = parse_url(getenv("DATABASE_URL"));
        
        
        $dbName = ltrim($dbPackage['path'], '/');
        $db = null;
        
        try {
            $db = new PDO("pgsql:host=$dbPackage['host'];port=$dbPackage['port'];dbname=$dbName", $dbPackage['user'], $dbPackage['pass']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        } catch (PDOException $e)
        {
            echo "Error" . $e->getMessage();
            die();
        }
        return $db;
    }




?>