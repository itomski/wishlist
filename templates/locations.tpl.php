<div>
    <h1>Locations</h1>
    <?php foreach($data as $element) { ?>
    <article>
        <header><?= $element->name ?? '' ?></header>
        <hr>
        <?= $element->street ?? '' ?> <?= $element->nr ?? '' ?><br>
        <?= $element->zip ?? '' ?><?= $element->city ?? '' ?><br>
        <?= $element->country ?? '' ?><br>
    </article>
    <?php } ?>
</div>
<div>
    <form action="locations.php" method="post">
        <h1>Neue Location</h1>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <fieldset class="grid">
            <div>
                <label for="street">Straße</label>
                <input type="text" name="street" id="street">
            </div>
            <div>
                <label for="nr">Nr</label>
                <input type="text" name="nr" id="nr">
            </div>
        </fieldset>
        <fieldset class="grid">
            <div>
                <label for="zip">PLZ</label>
                <input type="text" name="zip" id="zip">
            </div>
            <div>
                <label for="city">Ort</label>
                <input type="text" name="city" id="city">
            </div>
        </fieldset>
        <div>
            <label for="contry">Land</label>
            <input type="text" name="country" id="country">
        </div>
        <button type="submit">Speichern</button>
    </form>
</div>