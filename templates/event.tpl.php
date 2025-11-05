<div>
    <h1>Event</h1>
    <article>
        <?= $event->getName() ?? '' ?><br>
        <?= $event->getDescription() ?? '' ?><br>
        <?= $event->getStartAt() ?? '' ?>
    </article>
    <hr>
    <h2>Verwendete Playlisten:</h2>
    <?php

use Wishlist\ORM\Playlist;

 foreach($data as $element) { ?>
        <article>
            <?= $element->name ?? '' ?> (<?= $element->type ?? '' ?>) <br>
            <a href="index.php?a=remove&e=<?= $event->getId() ?>&p=<?= $element->id ?>">ENTFERNEN</a>
        </article>
    <?php } ?>
</div>
<div>
    <form action="event.php" method="post">
        <h1>Weitere Playlist hinzufügen</h1>
        <input type="hidden" name="event_id" id="event_id" value="<?= $event_id ?>">
        <div>
            <select name="playlist_id" aria-label="Select your favorite cuisine..." required>
                <option selected disabled value="">
                    Wähle eine Location aus...
                </option>
                <?php foreach(Playlist::allByCurrentUser() as $playlist) { ?>
                    <option value="<?= $playlist->id ?>"><?= $playlist->name ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit">Speichern</button>
    </form>
</div>