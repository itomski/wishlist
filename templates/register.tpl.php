<h1>Als Benutzer registrieren</h1>

<form action="register.php" method="post">

    <div>
        <label for="name">Benutzername</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">E-Mail</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Passwort</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="password_repeat">Passwort Wiederholung</label>
        <input type="password" name="password_conformation" id="password_conformation">
    </div>
    <button type="submit">Registrieren</button>
</form>