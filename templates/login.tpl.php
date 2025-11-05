<div>
    <h1>Login</h1>
    <?php

    use Wishlist\DataUtils;

    if(DataUtils::hasMessages()) {
        foreach(DataUtils::getMessages() as $msg) {
            echo '<p>'.$msg.'</p>';
        }
    }
    ?>
    <form action="login.php" method="post">
        <div>
            <label for="name">Benutzername</label>
            <input type="text" name="name" id="name" <?= ($_GET['i'] ?? '') === 'error' ? 'aria-invalid="true"' : '' ?>>
        </div>
        <div>
            <label for="password">Passwort</label>
            <input type="password" name="password" id="password" <?= ($_GET['i'] ?? '') === 'error' ? 'aria-invalid="true"' : '' ?>>
            <?php if(($_GET['i'] ?? '') === 'error') { ?>
            <small id="invalid-helper">
                Falsche Zugangsdaten
            </small>
            <?php } ?>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
<div></div>