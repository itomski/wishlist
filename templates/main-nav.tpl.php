<?php
use Wishlist\AccountUtils;
?>
<nav>
    <ul>
        <li><strong>Wishlist</strong></li>
    </ul>
    <ul>
        <?php if(AccountUtils::isLoggedIn()) { ?>
            <li><a href="?a=events">Events</a></li>
            <li><a href="?a=locations">Locations</a></li>
            <li><a href="?a=playlists">Playlists</a></li>
            <li><a href="?a=logout">Logout</a></li>
        <?php } else { ?>
            <li><a href="?a=login">Login</a></li>
            <li><a href="?a=register">Registrieren</a></li>
        <?php } ?>
    </ul>
</nav>