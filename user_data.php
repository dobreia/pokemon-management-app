<?php
session_start();
$errorUsername = "";
$errorEmail = "";
$errorPassword ="";
$errorPasswordConfirm = "";
$succeed = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];
    if (empty($username)) {
        $errorUsername = "A felhasználónév megadása kötelező!";
    } 
    if(empty($email)){
        $errorEmail = "Az email megadása kötelező!";
    }
    if (empty($password)) {
        $errorPassword = "A jelszó megadása kötelező!";
    } 
    if(empty($passwordConfirm)){
        $errorPasswordConfirm = "A jelszó újboli megadása kötelező!";
    }
    if (empty($errorUsername) && empty($errorEmail) && empty($errorPassword) && empty($errorPasswordConfirm)) {
        $userData = json_decode(file_get_contents('users.json'), true);
        foreach ($userData as $existingUsername => $existingUserData) {
            if (isset($existingUserData['email'])) {
                $existingEmail = $existingUserData['email'];
                if ($existingEmail == $email) {
                    $errorEmail = "Az email cím már regisztrálva van!";
                    break;
                }
            }
        }
        if (isset($userData[$username])) {
            $errorUsername = "A felhasználónév már foglalt!";
        }else if($password !== $passwordConfirm){
            $errorPassword = "A két jelszó nem egyezik!";
        }else{
            $userData[$username] = array(
                'email' => $email,
                'password' => $password,
                'balance' => 500,
                'isAdmin' => false,
                'owned_cards' => []
            );
            file_put_contents('users.json', json_encode($userData));
        
            $succeed = "Sikeres regisztráció!";
            $_SESSION['username'] = $username;
            header("Location: indexLogin.php");
            exit();
        }
        
    }
}

$sentUsername = isset($_POST['username']) ? $_POST['username'] : "";
$sentEmail = isset($_POST['email']) ? $_POST['email'] : "";
$sentPassword = isset($_POST['password']) ? $_POST['password'] : "";
$sentPasswordConfirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKémon | Bejelentkezés</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>
    <header>
        <h1><a href="indexLogoff.php">IKémon</a> > Regisztráció</h1>
        <div class="login-container">
            <h3><a href="login.php">Bejelentkezés</a></h3>
        </div>
    </header>
    
    <form method="post" action="register.php" novalidate>
    <?php 
        if (!empty($errorUsername)) {
            echo '<p style="color: red;">' . $errorUsername . '</p>';
        }
        if (!empty($errorEmail)) {
            echo '<p style="color: red;">' . $errorEmail . '</p>';
        }
        if (!empty($errorPassword)) {
            echo '<p style="color: red;">' . $errorPassword . '</p>';
        }
        if (!empty($errorPasswordConfirm)) {
            echo '<p style="color: red;">' . $errorPasswordConfirm . '</p>';
        }
        if (!empty($succeed)) {
            echo '<p style="color: green;">' . $succeed . '</p>';
        }
    ?>
        Felhasználónév: <input type="text" name="username" value="<?php echo $sentUsername ?>"><br>
        E-mail: <input type="email" name="email" value="<?php echo $sentEmail ?>"><br>
        Jelszó: <input type="password" name="password" value="<?php echo $sentPassword ?>"><br>
        Jelszó újra: <input type="password" name="password_confirm" value="<?php echo $sentPasswordConfirm ?>"><br>
        <?php 
        if(empty($errorUsername) && empty($errorEmail) && empty($errorPassword) && empty($errorPasswordConfirm)){
            echo '<p style="color: green;">' . $succeed . '</p>';
        }
        ?>
        <br>
        <input type="submit" value="Regisztráció">
    </form>
</body>
</html>
