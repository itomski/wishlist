<?php

try {
    echo "START: ".__FILE__.'<br>';
    $sql = "CREATE TABLE IF NOT EXISTS playlists_to_events (
                event_id BINARY(16),
                playlist_id BINARY(16),
                FOREIGN KEY (event_id) REFERENCES events(id),
                FOREIGN KEY (playlist_id) REFERENCES playlists(id))";

    $dbh->query($sql);

    echo "END: ".__FILE__.'<br>';
}
catch(PDOException $e) {
    echo "<p>ERROR: ".__FILE__.'<br>';
    print_r($e->errorInfo);
    die();
}