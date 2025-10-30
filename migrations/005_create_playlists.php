<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = "CREATE TABLE IF NOT EXISTS playlists (
                id BINARY(16) PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                type ENUM('private','public') DEFAULT 'private',
                user_id BINARY(16),
                FOREIGN KEY (user_id) REFERENCES users(id))";

    $dbh->query($sql);

    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}