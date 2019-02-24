<?php
    
    function get_db()
    {
        $dbPackage = parse_url(getenv("DATABASE_URL"));
        
        
        $dbName = ltrim($dbPackage['path'], '/');
        $dbHost = $dbPackage['host'];
        $dbPort = $dbPackage['port'];
        $db = null;
        
        try {
            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbPackage['user'], $dbPackage['pass']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;

        } catch (PDOException $e)
        {
            echo "Error" . $e->getMessage();
            die();
        }
        return $db;
    }




?>