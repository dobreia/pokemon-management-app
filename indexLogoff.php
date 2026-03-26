<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['username'];
$cardsData = json_decode(file_get_contents("pokemon_data.json"), true);

$userData = json_decode(file_get_contents("users.json"), true);

if (isset($userData[$userName])) {
    $userBalance = $userData[$userName]['balance'];
    $isAdmin = $userData[$userName]['isAdmin'];
}

$userOwnedCards = isset($userData[$userName]['owned_cards']) ? $userData[$userName]['owned_cards'] : [];
$errorBuy = "";
$successBuy = "";
$start = "";
$admin = "Admin";
if (isset($_POST['buyCard'])) {
    $cardId = $_POST['buyCard'];
    
    if(in_array($cardId, $userData[$userName]['owned_cards'])){
        $errorBuy = "Ez a kártya már megvan!";
    }
    elseif($userBalance < $cardsData[$cardId]['price']){
        $start = $cardsData[$cardId]['name'][0];
        if(in_array(strtolower($start),["a", "á", "e", "é", "i", "í", "o", "ó", "ö", "ő", "u", "ú", "ü", "ű"])){
            $errorBuy = "Nincs elég pénzed az ".$cardsData[$cardId]['name']." megvételéhez!";
        }else $errorBuy = "Nincs elég pénzed a ".$cardsData[$cardId]['name']." megvételéhez!";
    }
    elseif(count($userData[$userName]['owned_cards']) == 5){
        $errorBuy = "Legfeljebb 5 kártyát birtokolhatsz!";
    }
    else{
        $start = "";
        if(in_array(strtolower($start),["a", "á", "e", "é", "i", "í", "o", "ó", "ö", "ő", "u", "ú", "ü", "ű"])){
            $successBuy = "Sikeresen megvetted az ".$cardsData[$cardId]['name']." kártyát!";
        }else $successBuy = "Sikeresen megvetted a ".$cardsData[$cardId]['name']." kártyát!";

        $userBalance -= $cardsData[$cardId]['price'];
        $userOwnedCards[] = $cardId;
        $index = array_search($cardId, $userData['Admin']['owned_cards']);
        unset($userData["Admin"]['owned_cards'][$index]);
        $userData[$userName]['balance'] = $userBalance;
        $userData[$userName]['owned_cards'] = $userOwnedCards;
        
        file_put_contents("users.json", json_encode($userData, JSON_PRETTY_PRINT));
    }
}

if(isset($_POST['buyRandomCard'])){
    $cardId = 'card'.rand(0, count($userData[$admin]['owned_cards'])-1);
    if($userBalance < 300){
        $errorBuy = "Nincs elég pénzed hozzá!";
    }
    elseif(in_array($cardId, $userData[$userName]['owned_cards'])){
        $start = $cardsData[$cardId]['name'][0];
        if(in_array(strtolower($start),["a", "á", "e", "é", "i", "í", "o", "ó", "ö", "ő", "u", "ú", "ü", "ű"])){
            $errorBuy = "A sorsolt kártya az ".$cardsData[$cardId]['name'].", de ez már megvan neked!";
        }else $errorBuy = "A sorsolt kártya a ".$cardsData[$cardId]['name'].", de ez már megvan neked!";
    }
    elseif(count($userData[$userName]['owned_cards']) == 5){
        $errorBuy = "Legfeljebb 5 kártyát birtokolhatsz!";
    }
    else{
        if(in_array(strtolower($start),["a", "á", "e", "é", "i", "í", "o", "ó", "ö", "ő", "u", "ú", "ü", "ű"])){
            $successBuy = "Sikeresen megvetted az ".$cardsData[$cardId]['name']." kártyát! Ennek eredeti ára: ".$cardsData[$cardId]['price']." coin";
        }else $successBuy = "Sikeresen megvetted a ".$cardsData[$cardId]['name']." kártyát! Ennek eredeti ára: ".$cardsData[$cardId]['price']." coin";
        $userBalance -= 300;

        $userOwnedCards[] = $cardId;
        $index = array_search($cardId, $userData[$admin]['owned_cards']);
        unset($userData[$admin]['owned_cards'][$index]);
        $userData[$userName]['balance'] = $userBalance;
        $userData[$userName]['owned_cards'] = $userOwnedCards;
        
        file_put_contents("users.json", json_encode($userData, JSON_PRETTY_PRINT));
    }
}

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
        <h1><a href="indexLogin.php">IKémon</a> > Home</h1>
        <div class="login-container">
            <h3>Egyenleg: <?php echo $userBalance; ?></h3>
            <h3><a href="user_data.php">Bejelentkezve: <?php echo $userName; ?></a></h3>
            <h3><a href="logout.php">Kijelentkezés</a></h3>
             
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
        <?php 
        if(!$isAdmin){
            echo '<form method="post" action="indexLogin.php">';
            echo '<input type="hidden" name="buyRandomCard">';
            echo '<button style = "font-size: 15px; background-color: var(--clr-main); color: var(--clr-white); padding: 10px 15px;border: none; border-radius: 4px; cursor: pointer;transition: background-color 0.2s; margin-top: 20px;"';
            echo 'type="submit">Random Pokemon vásárlása';
            echo '<span class="card-price"><span class="icon">💰</span>300</span>';
            echo '</button>';
            echo '</form>';
        }
        ?>
        
        <?php 
            
            if(!empty($errorBuy)) echo '<h2 style = "color: red;">'.$errorBuy.'</h2>';  
            elseif (!empty($successBuy)) echo '<h2 style = "color: green;">'.$successBuy.'</h2>'; 
        ?>
        <div id="card-list">
            <?php
            $admin = "Admin";
            $typeFilter = isset($_GET['typeFilter']) ? $_GET['typeFilter'] : "";
            foreach ($cardsData as $cardId => $card) {
                if(isset($userData[$admin]['owned_cards']) && in_array($cardId, $userData[$admin]['owned_cards'])){
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
                        echo '<div class="buy">';
                        if(!$isAdmin){
                            echo '<form method="post" action="indexLogin.php">';
                            echo '<input type="hidden" name="buyCard" value="' . $cardId . '">';
                            echo '<button type="submit" class="invisible-button" style="border: none; padding: 0; background: none; cursor: pointer;color: var(--clr-white);    font-size: 20px;">';
                         echo '<span class="card-price"><span class="icon">💰</span> ' . $card['price'] . '</span>';
                        }
                        else{
                            echo '<form method="post" action="">';
                            echo '<input type="hidden" name="editCard" value="' . $cardId . '">';
                            echo '<button type="submit" class="invisible-button" style="border: none; padding: 0; background: none; cursor: pointer;color: var(--clr-white);    font-size: 20px;">';
                             echo 'Kártya szerkesztése';
                        }
                        
                        echo '</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            ?>

            <?php
            if ($isAdmin) {
                echo '<h2 id=new-card><a href="admin.php">Új kártya hozzáadása</a></h2>';
            }
            ?>
        </div>
    </div>
    <footer>
        <p>IKémon | ELTE IK Webprogramozás</p>
    </footer>
</body>

</html>
