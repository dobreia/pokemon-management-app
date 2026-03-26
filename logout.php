<?php
session_start(); 
$errorUsername = "";
$errorPassword = "";
$errorLogin = "";
$sentUsername = "";
$sentPassword = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errorUsername = "A mező kitöltése kötelező!";
    } 
    if(empty($password)){
        $errorPassword = "A mező kitöltése kötelező!";
    }
    if(empty($errorPassword) && empty($errorUsername)){
        $userData = json_decode(file_get_contents('users.json'), true);

        if (isset($userData[$username]) && $userData[$username]['password'] == $password) {
            $_SESSION['username'] = $username;
            header("Location: indexLogin.php"); 
            exit();
        } else {
            $errorLogin = "Hibás felhasználónév vagy jelszó!";
        }
    }
    $sentUsername = isset($username) ? $username : "";
    $sentPassword = isset($password) ? $password : "";
}
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
        <h1><a href="indexLogoff.php">IKémon</a> > Bejelentkezés</h1>
        <div class="login-container">
            <h3><a href="register.php">Regisztráció</a></h3>
        </div>
    </header>
    <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
            <?php 
            if (!empty($errorUsername)) {
                echo '<p style="color: red;">' . $errorUsername . '</p>';
            }
            if (!empty($errorPassword)) {
                echo '<p style="color: red;">' . $errorPassword . '</p>';
            }
            if (!empty($errorLogin)) {
                echo '<p style="color: red;">' . $errorLogin . '</p>';
            }
            ?>
            <label for="username">Felhasználónév:</label>
            <input type="text" id="username" name="username" value="<?php echo $sentUsername ?>">
            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password" value="<?php echo $sentPassword ?>">
            <button type="submit">Bejelentkezés</button>
        </form>
    </div>
</body>

</html>
