<?php

use Wishlist\DataUtils;
?>
<form action="register.php" method="post">
    <h1>Als Benutzer registrieren</h1>
    <div>
        <label for="name">Benutzername</label>
        <input type="text" name="name" id="name" <?= (DataUtils::hasError('name') ? 'aria-invalid="true"' : '') ?> value="<?= DataUtils::getOldByKey('name') ?? '' ?>">
        <?php if(DataUtils::hasError('name')) { ?>
        <small id="invalid-helper">
            <?php foreach(DataUtils::getErrorsByKey('name') as $value) { ?>
                <?= $value ?></br>
            <?php } ?>
        </small>
        <?php } ?>
    </div>
    <div>
        <label for="email">E-Mail</label>
        <input type="text" name="email" id="email" <?= (DataUtils::hasError('email') ? 'aria-invalid="true"' : '') ?> value="<?= DataUtils::getOldByKey('email') ?? '' ?>">
        <?php if(DataUtils::hasError('email')) { ?>
        <small id="invalid-helper">
            <?php foreach(DataUtils::getErrorsByKey('email') as $value) { ?>
                <?= $value ?></br>
            <?php } ?>
        </small>
        <?php } ?>
    </div>
    <div>
        <label for="password">Passwort</label>
        <input type="password" name="password" id="password" <?= (DataUtils::hasError('password') ? 'aria-invalid="true"' : '') ?> value="<?= DataUtils::getOldByKey('password') ?? '' ?>">
        <?php if(DataUtils::hasError('password')) { ?>
        <small id="invalid-helper">
            <?php foreach(DataUtils::getErrorsByKey('password') as $value) { ?>
                <?= $value ?></br>
            <?php } ?>
        </small>
        <?php } ?>
    </div>
    <div>
        <label for="password_repeat">Passwort Wiederholung</label>
        <input type="password" name="password_conformation" id="password_conformation" <?= (DataUtils::hasError('password_conformation') ? 'aria-invalid="true"' : '') ?> value="<?= DataUtils::getOldByKey('password_conformation') ?? '' ?>">
        <?php if(DataUtils::hasError('password_conformation')) { ?>
        <small id="invalid-helper">
            <?php foreach(DataUtils::getErrorsByKey('password_conformation') as $value) { ?>
                <?= $value ?></br>
            <?php } ?>
        </small>
        <?php } ?>
    </div>
    <button type="submit">Registrieren</button>
</form>