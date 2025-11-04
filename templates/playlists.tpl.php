<div>
    <h1>Playlists</h1>
    <?php foreach($data as $element) { ?>
    <article>
        <header><?= $element->name ?? '' ?></header>
        <?= $element->type === 'private' ? 'Privat' : 'Öffentlich' ?>
        <a href="index.php?a=songs&p=<?= $element->id ?>">Bearbeiten</a>
    </article>
    <?php } ?>
</div>
<div>
    <form action="playlists.php" method="post">
        <h1>Neue Playlist</h1>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="type">Playlist-Typ</label>
            <select name="type" required>
                <option selected disabled value="">
                    Wähle einen Typ aus
                </option>
                <option value="private">Privat</option>
                <option value="public">Öffentlich</option>
            </select>
        </div>
        <button type="submit">Speichern</button>
    </form>
</div>