<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?=$title?></title>
    <meta charset="utf-8"/>
    <?php foreach ($css as $style) { ?>
        <link rel="stylesheet" href="../resources/style/<?php echo $style ?>"/>
    <?php } ?>
    <link rel="stylesheet" href="../resources/style/main.css">
    <link rel="stylesheet" href="../resources/style/nav.css">
</head>
<body>
<?php include_once $page; ?>
</body>
</html>