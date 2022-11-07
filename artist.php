<!doctype html>
<html lang="fr">

<?php

require 'Auth-Spotify.php';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . $_GET['id']);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = json_decode(curl_exec($ch));

echo "<pre>";
//echo sizeof($result->artists->items);
//echo $result->artists->items[0]->images[0]->url;
var_dump($result);
echo "</pre>";

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artist</title>
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
            <?php foreach ($result->artists->items as $item) { ?>
                <div class="col-lg-4 mb-5">
                    <div class="card shadow-sm">
                        <!--<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
                        <img class="bd-placeholder-img card-img-top"
                             src="<?php echo $item->images[0]->url ?>"
                             alt="Image de l'artiste <?php echo $item->name ?>">
                        <div class="card-body">
                            <h2><?php echo $item->name ?></h2>
                            <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?php echo $item->external_urls->spotify ?>">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Spotify</button>
                                    </a>
                                    <a href="artist.php" class="ms-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Voir plus...
                                        </button>
                                    </a>
                                </div>
                                <small class="text-muted"><?php echo $item->followers->total ?>
                                    listeners</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
