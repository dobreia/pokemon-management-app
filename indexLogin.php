<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $jsonData = file_get_contents('pokemon_data.json');
    $pokemonList = json_decode($jsonData, true);

    if (isset($pokemonList[$id])) {
        $pokemonData = $pokemonList[$id];
    } else {
        echo "Pokémon not found!";
        exit;
    }
} else {
    echo "Pokémon ID is missing!";
    exit; 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKémon | <?php echo $pokemonData['name']; ?></title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/details.css">
</head>

<body>
    <header>
        <h1><a href="indexLogin.php">IKémon</a> > <?php echo $pokemonData['name']; ?></h1>
    </header>
    <div id="content">
        <div id="details">
            <div class="image clr-<?php echo $pokemonData['type']; ?>">
                <img src="<?php echo $pokemonData['image']; ?>" alt="">
            </div>
            <div class="info">
                <div class="description"><?php echo $pokemonData['description']; ?></div>
                <span class="card-type"><span class="icon">🏷</span> Type: <?php echo $pokemonData['type']; ?></span>
                <div class="attributes">
                    <div class="card-hp"><span class="icon">❤</span> Health: <?php echo $pokemonData['hp']; ?></div>
                    <div class="card-attack"><span class="icon">⚔</span> Attack: <?php echo $pokemonData['attack']; ?></div>
                    <div class="card-defense"><span class="icon">🛡</span> Defense: <?php echo $pokemonData['defense']; ?></div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>IKémon | ELTE IK Webprogramozás</p>
    </footer>
</body>

</html>
