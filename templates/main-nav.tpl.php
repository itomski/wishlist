<nav class="container">
    <ul>
        <li><strong>Wishlist</strong></li>
    </ul>
    <ul>
        <?php if(isset($_SESSION['login']) && $_SESSION['login'] === true) { ?>
            <li><a href="?a=events">Events</a></li>
        <?php } else { ?>
            <li><a href="?a=login">Login</a></li>
            <li><a href="?a=register">Registrieren</a></li>
        <?php } ?>
    </ul>
</nav>