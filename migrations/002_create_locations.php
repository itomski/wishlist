<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = 'CREATE TABLE IF NOT EXISTS locations (
                id BINARY(16) PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                street VARCHAR(100),
                nr VARCHAR(20),
                zip VARCHAR(20),
                city VARCHAR(20),
                country VARCHAR(20)
            )';
    $dbh->query($sql);
    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}