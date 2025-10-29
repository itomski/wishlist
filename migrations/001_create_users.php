<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = 'CREATE TABLE IF NOT EXISTS users (
                id BINARY(16) PRIMARY KEY,
                name VARCHAR(25) UNIQUE NOT NULL,
                email VARCHAR(50) UNIQUE NOT NULL,
                password VARCHAR(200) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP DEFAULT NULL
            )';
    $dbh->query($sql);
    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}