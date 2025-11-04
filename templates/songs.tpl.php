<div>
    <h1>Songs</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Interpret</th>
                <th scope="col">Titel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $element) { ?>
            <tr>
                <td><?= $element->interpret ?></td>
                <td><?= $element->title ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div>
    <form action="songs.php" method="post">
        <h1>Neue Songs zur Playlist</h1>
        <input type="hidden" name="playlist_id" value="<?= $playlistId ?>">
        <div>
            <label for="interpret">Interpret</label>
            <input type="text" name="interpret" id="interpret">
        </div>
        <div>
            <label for="title">Titel</label>
            <input type="text" name="title" id="title">
        </div>
        <button type="submit">Speichern</button>
    </form>
</div>