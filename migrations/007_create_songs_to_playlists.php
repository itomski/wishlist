<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = "CREATE TABLE IF NOT EXISTS songs_to_playlist (
                song_id BINARY(16),
                playlist_id BINARY(16),
                status ENUM('open', 'closed', 'rejected') DEFAULT 'open',
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (song_id) REFERENCES songs(id),
                FOREIGN KEY (playlist_id) REFERENCES playlists(id))";

    $dbh->query($sql);

    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}