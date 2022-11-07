<!doctype html>
<html lang="fr">

<?php

use App\Autoloader;
use App\Entity\Artist;
require 'Auth-Spotify.php';
require_once 'Autoloader.php';

Autoloader::register();

$ch = curl_init();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=" . preg_replace('/\s+/', '_', $_POST['artist']) . "&type=artist");
} else {
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=vald&type=artist");
}
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($ch));

echo "<pre>";
//echo sizeof($result->artists->items);
//echo $result->artists->items[0]->images[0]->url;
//var_dump($result->artists);
echo "</pre>";

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

<header>
    <form class="p-2" method="post" enctype="multipart/form-data">
        <div class="input-group container">
            <label class="d-none" for="artist">Sujet :</label>
            <input name="artist" id="artist" type="text" class="form-control" placeholder="Artiste">
            <button type="submit" class="btn btn-secondary">Chercher</button>
        </div>
    </form>
</header>

<main class="bg-light">
    <section class="album py-5 container">
        <div class="row">
            <?php foreach ($result->artists->items as $item) {
                $artist = new Artist($item->id, $item->name, $item->followers->total, $item->genres, $item->external_urls->spotify, $item->images[0]->url);
                echo $artist->display();
            } ?>
        </div>
    </section>
</main>

<footer></footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

</body>

<?php curl_close($ch); ?>

</html>
