<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['username'];

$userData = json_decode(file_get_contents("users.json"), true);

if (isset($userData[$userName])) {
    $userBalance = $userData[$userName]['balance'];
}

$errorName = "";
$errorType = "";
$errorHP = "";
$errorAttack = "";
$errorDefense = "";
$errorPrice = "";
$errorDescription = "";
$errorImage = "";
$success="";
$sentName = "";
$sentType = "";
$sentHP = "";
$sentAttack = "";
$sentDefense = "";
$sentPrice = "";
$sentDescription = "";
$sentImage = "";
if (isset($_POST['addCard'])) {
    $newCard = array(
        'name' => $_POST['name'],
        'type' => $_POST['type'],
        'hp' => intval($_POST['hp']),
        'attack' => intval($_POST['attack']),
        'defense' => intval($_POST['defense']),
        'price' => intval($_POST['price']),
        'description' => $_POST['description'],
        'image' => $_POST['image']
    );

    if (empty($newCard['name'])) {
        $errorName = "A név megadása kötelező!";
    }


    if (empty($newCard['type'])) {
        $errorType = "A típus megadása kötelező!";
    }

    if (empty($newCard['hp'])) {
        $errorHP = "Az életerő megadása kötelező!";
    }elseif ($newCard['hp'] <= 0) {
        $errorHP = "Az életerő értéke csak pozitív egész lehet!";
    }
    if (empty($newCard['attack'])) {
        $errorAttack = "A támadás megadása kötelező!";
    }elseif ($newCard['attack'] < 0) {
        $errorAttack = "A támadás értéke nem lehet negatív!";
    }

    if (empty($newCard['defense'])) {
        $errorDefense = "A védekezés megadása kötelező!";
    }elseif ($newCard['defense'] < 0) {
        $errorDefense = "A védekezés értéke nem lehet negatív!";
    }
    if (empty($newCard['price'])) {
        $errorPrice = "Az ár megadása kötelező!";
    }elseif ($newCard['price'] <= 0) {
        $errorPrice = "Az ár értéke csak pozitív egész lehet!";
    }

    if (empty($newCard['description'])) {
        $errorDescription = "A leírás megadása kötelező!";
    }

    if (empty($newCard['image'])) {
        $errorImage = "A kép linkjének megadása kötelező!";
    }

    if (empty($errorName) && empty($errorAttack) && empty($errorDefense) && empty($errorDescription) && empty($errorHP) && empty($errorImage) && empty($errorPrice) && empty($errorType)) {
        $cardsData = json_decode(file_get_contents("pokemon_data.json"), true);

        $cardId = 'card' . count($cardsData);
        
        $cardsData[$cardId] = $newCard;
        array_push($userData[$userName]['owned_cards'], $cardId);
        file_put_contents("pokemon_data.json", json_encode($cardsData, JSON_PRETTY_PRINT));
        file_put_contents("users.json", json_encode($userData, JSON_PRETTY_PRINT));
        $success = "Az új kártya sikeresen létrehozva!";
    }
    $sentName = isset($newCard['name']) ? $newCard['name'] : "";
    $sentType = isset($newCard['type']) ? $newCard['type'] : "";
    $sentHP = isset($newCard['hp']) ? $newCard['hp'] : "";
    $sentAttack = isset($newCard['attack']) ? $newCard['attack'] : "";
    $sentDefense = isset($newCard['defense']) ? $newCard['defense'] : "";
    $sentPrice = isset($newCard['price']) ? $newCard['price'] : "";
    $sentDescription = isset($newCard['description']) ? $newCard['description'] : "";
    $sentImage = isset($newCard['image']) ? $newCard['image'] : "";
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
    <link rel="stylesheet" href="styles/form.css">
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
    <form method="post" action="admin.php">
        <?php 
        if (!empty($errorName)) {
            echo '<p style="color: red;">' . $errorName . '</p>';
        }
        if (!empty($errorType)) {
            echo '<p style="color: red;">' . $errorType . '</p>';
        }
        if (!empty($errorHP)) {
            echo '<p style="color: red;">' . $errorHP . '</p>';
        }
        if (!empty($errorAttack)) {
            echo '<p style="color: red;">' . $errorAttack . '</p>';
        }
        if (!empty($errorDefense)) {
            echo '<p style="color: red;">' . $errorDefense . '</p>';
        }
        if (!empty($errorPrice)) {
            echo '<p style="color: red;">' . $errorPrice . '</p>';
        }
        if (!empty($errorDescription)) {
            echo '<p style="color: red;">' . $errorDescription . '</p>';
        }
        if (!empty($errorImage)) {
            echo '<p style="color: red;">' . $errorImage . '</p>';
        }
        if(!empty($success)){
            echo '<p style="color: green;">'. $success . '</p>';
        }
        ?>
        <label for="name">Név:</label>
        <input type="text" id="name" name="name" value="<?php echo $sentName ?>">

        <label for="type">Típus:</label>
        <input type="text" id="type" name="type" value="<?php echo $sentType ?>">

        <label for="hp">Életerő:</label>
        <input type="number" id="hp" name="hp" value="<?php echo $sentHP ?>">

        <label for="attack">Támadás:</label>
        <input type="number" id="attack" name="attack" value="<?php echo $sentAttack ?>">

        <label for="defense">Védekezés:</label>
        <input type="number" id="defense" name="defense" value="<?php echo $sentDefense ?>">

        <label for="price">Ár:</label>
        <input type="number" id="price" name="price" value="<?php echo $sentPrice ?>">

        <label for="description">Leírás:</label>
        <input type="text" id="description" name="description" value="<?php echo $sentDescription ?>">

        <label for="image">Kép</label>
        <input type="text" id="image" name="image" placeholder="Egy képnek a linkje..." value="<?php echo $sentImage ?>">

        <button type="submit" name="addCard">Kártya Hozzáadása</button>
    </form>

</body>
</html>
