<?php
$cardsData = json_decode(file_get_contents("pokemon_data.json"), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKémon | Home</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/cards.css">
</head>

<body>
    <header>
        <h1><a href="indexLogoff.php">IKémon</a> > Home</h1>
        <div class="login-container">
            <h3><a href="register.php">Regisztráció</a></h3>
            <h3><a href="login.php">Bejelentkezés</a></h3>
        </div>
    </header>
   
    <div id="content">
        <form method="get">
            <label for="typeFilter">Szűrés típus szerint:</label>
            <select name="typeFilter" id="typeFilter">
                <option value="">Mind</option>
                <?php
                $availableTypes = array_unique(array_column($cardsData, 'type'));
                foreach ($availableTypes as $type) {
                    echo '<option value="' . $type . '">' . ucfirst($type) . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Szűrés">
        </form>
        <div id="card-list">
            <?php
            $typeFilter = isset($_GET['typeFilter']) ? $_GET['typeFilter'] : "";
            foreach ($cardsData as $cardId => $card) {
                if(empty($typeFilter) || $card['type'] == $typeFilter) {
                    echo '<div class="pokemon-card">';
                    echo '<div class="image clr-' . $card['type'] . '">';
                    echo '<img src="' . $card['image'] . '" alt="">';
                    echo '</div>';
                    echo '<div class="details">';
                    echo '<h2><a href="details.php?id=' . $cardId . '">' . $card['name'] . '</a></h2>';
                    echo '<span class="card-type"><span class="icon">🏷</span> ' . $card['type'] . '</span>';
                    echo '<span class="attributes">';
                    echo '<span class="card-hp"><span class="icon">❤</span> ' . $card['hp'] . '</span>';
                    echo '<span class="card-attack"><span class="icon">⚔</span> ' . $card['attack'] . '</span>';
                    echo '<span class="card-defense"><span class="icon">🛡</span> ' . $card['defense'] . '</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            
            ?>
        </div>
    </div>
    <footer>
        <p>IKémon | ELTE IK Webprogramozás</p>
    </footer>
</body>

</html>
