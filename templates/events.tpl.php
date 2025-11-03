<div>
    <h1>Events</h1>
    <?php

use Wishlist\DataGateway;

 foreach($data as $element) { ?>
    <article>
        <header><?= $element->getName() ?? '' ?></header>
        <?= $element->getDescription() ?? '' ?><br>
        <?= $element->getStartAt() ? date('d.m.y H:i', $element->getStartAt()) : '' ?>
    </article>
    <?php } ?>
</div>
<div>
    <form action="events.php" method="post">
        <h1>Neues Event</h1>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <textarea name="description" placeholder="Beschreibung"></textarea>
        </div>
        <div>
            <label for="start_at">Start</label>
            <input type="datetime-local" name="start_at" id="start_at">
        </div>
        <div>
            <select name="location_id" aria-label="Select your favorite cuisine..." required>
                <option selected disabled value="">
                    Wähle eine Location aus...
                </option>
                <?php foreach(DataGateway::getAllLocations() as $location) { ?>
                    <option value="<?= $location['id'] ?>"><?= $location['name'].($location['city'] ? ', '.$location['city'] : '') ?></option>
                <?php } ?>
            </select>
        </div>
        
        <button type="submit">Speichern</button>
    </form>
</div>