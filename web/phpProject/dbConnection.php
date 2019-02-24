<?php
    
    function get_db()
    {
        $dbPackage = parse_url(getenv("DATABASE_URL"));
        
        
        $dbName = ltrim($dbPackage['path'], '/');
        $dbHost = $dbPackage['host'];
        $dbPort = $dbPackage['port'];
        $dbUser = $dbPackage['user'];
        $dbPassword = $dbPackage['pass'];

        $db = null;
        
        try {
            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e)
        {
            echo "Error" . $e->getMessage();
            die();
        }
        return $db;
    }




?>