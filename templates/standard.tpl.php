<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pico.min.css">
    <title>...</title>
</head>
<body>
    <div class="container">
        <?php include_once '../templates/main-nav.tpl.php' ?>

        <main class="grid">
            <?php include_once '../templates/'.$subTpl ?>
        </main>
    </div>
</body>
</html>