<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = 'CREATE TABLE IF NOT EXISTS songs (
                id BINARY(16) PRIMARY KEY,
                interpret VARCHAR(50) NOT NULL,
                title VARCHAR(50) NOT NULL)';
    $dbh->query($sql);

    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}