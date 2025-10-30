<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = 'CREATE TABLE IF NOT EXISTS events (
                id BINARY(16) PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                description TEXT,
                location_id BINARY(16),
                start_at TIMESTAMP DEFAULT NULL,
                user_id BINARY(16),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (location_id) REFERENCES locations(id))';
    $dbh->query($sql);

    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}