<?php

    require_once 'include/db_connect.php';
    $email = $password = "";
    $emailErr = $passwordErr = "";

    $content["login__err_email"] = "Please enter your email.";
    $content["login__err_password"] = "Please enter your password.";
    $content["login__err_password_not_valid"] = "The password you entered was not valid.";
    $content["login__err_no_email"] = "'No account found with that email.";
    $content["login__err_oops"] = "Oops! Something went wrong. Please try again later.";



    if(!empty($_POST)){
        // Check if username is empty
        if(empty(trim($_POST["email"]))){
            $emailErr = $content["login__err_email"];
        } else{
            $email = trim($_POST["email"]);
        }

        // Check if password is empty
        if(empty(trim($_POST['password']))){
            $passwordErr = $content["login__err_password"];
        } else{
            $password = trim($_POST['password']);
        }
        // Validate credentials
        if(empty($emailErr) && empty($passwordErr)){
            // Prepare a select statement
            $sql = "SELECT user_email, user_password FROM users WHERE user_email = ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $paramEmail);

                // Set parameters
                $paramEmail = $email;

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $email, $hashedPassword);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashedPassword)){
                                /* Password is correct, so start a new session and
                                save the username to the session */
                                session_start();
                                $_SESSION['user_id'] = $email;
                                header("location: browse.php");
                            } else{
                                // Display an error message if password is not valid
                                $passwordErr = $content["login__err_password_not_valid"];
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $emailErr = $content["login__err_no_email"];
                    }
                } else{
                    echo $content["login__err_oops"];
                }
            }

        }

    }


    if(isset($_POST["language"])){
        $language = $_POST["language"];
        setcookie("language", $language, time() + (86400 * 30), "/");
    }elseif(!isset($_COOKIE["language"])) {
        $language = "en";
        setcookie("language", $language, time() + (86400 * 30), "/");
    }else{
        $language=$_COOKIE["language"];
    }
    

    require_once ('vendor/autoload.php');
    use \Statickidz\GoogleTranslate;
    $content["login__sign_in_account"]="If you have previously created a profile and are a registered guide, please sign in below";
    $content["login__login_general_use_description"]= "This website will allow you to either help guide an immagrant family or if you are an immagrant family you can find a resdient family to help make your transtion to your new home smoother. Don't worry, your information is confidential and secure";
    $content["login__sign_in_header_text_bold"]= "Sign in";
    $content["login__login"] = "Login";
    $content["login__create_account_button"]= "Create Account";
    $content["login__sign_in_header_text"]= "to your account";
    $content["login__create_account"]="If you are new to this website, click the button below to get started on your personal profile and make one step closer to finding your future guide";

    $content["login__log_in"]= "log in";
    $content["login__lpersonal_acc"]= "personal account";
    $content["login__sign_up"]= "sign up";
    $content["login__spersonal_acc"]= "personal account";


    $trans = new GoogleTranslate();
    foreach($content as $key => $text){
        $content["$key"] = $trans->translate("en", $language, $text);
    }

    // Close connection
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php $content["login__login"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/theme.css">
        <script src="js/main.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>

<body>

<header>
    <div class="title"><b><?php echo  $content["login__sign_in_header_text_bold"]; ?></b> <?php echo $content["login__sign_in_header_text"]; ?></div>
    <div class="sub-title"><?php echo  $content["login__login_general_use_description"]; ?></div>
</header>

<main>
        <div class="divider">
            <div class="grade"><?php echo  $content["login__log_in"]; ?></div>
            <div class="date"><?php echo  $content["login__lpersonal_acc"]; ?></div>
        </div>

        <div class="box-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="card-row-header" style="padding-top: 20px;">
                    <div class="card-field"><input id ="input-user" type="text" name="email" placeholder="johnsmith@gmail.com"><?php echo $emailErr; ?><br>email</div>
                    <div class="card-field"><input id="input-lock" type="password" name="password" placeholder="●●●●●●●●●●●"><?php echo $passwordErr; ?><br>password</div>
                </div>
                <div class="card-row-header">
                    <div class="card-field"><button type="submit" name="login_submit"><?php echo $content["login__sign_in_button"]; ?></button></div>
                </div>

        </form>
    </div>

    <div class="divider">
        <div class="grade"><?php echo  $content["login__sign_up"]; ?></div>
        <div class="date"><?php echo  $content["login__spersonal_acc"]; ?></div>
    </div>
    <div class="box-container">
        <div class="card-row-header" style="padding-top: 20px;">
            <div class="card-field"><?php echo $content["login__create_account"]; ?></div>
        </div>

        <div class="content">
            <div class="text"><?php echo $content["login__create_account"]; ?></div>
            <a href="signup.php"><button> <?php echo $content["login__create_account_button"]; ?></button></a>
            
        </div>
    
</div>
</main>

</body>
<footer>

    <div id = "language-display" class="languages"><script>displayLanguage('<?php echo $language?>');</script></div>
    <div id="language-footer">
<<<<<<< HEAD
        <div id="language-display"></div><img id="flag-filipino" src="images/flag-filipino.png" style = "width:30px">
=======
        <div id = "language-display" class="languages"><script>displayLanguage('<?php echo $language?>');</script></div>
<<<<<<< HEAD
        
        <div class="container">
        <img id="flag-spanish" height="2" src="images/flag-spanish.png" alt="Spanish Flag" data="es" onclick="languageSelect('flag-spanish')">   
        <img id="flag-usa" src="images/flag-usa.png" alt="USA Flag" data="en" onclick="languageSelect('flag-usa')">
        <img id="flag-arabic" src="images/flag-arabic.png" alt="Arabic Flag" data="ar" onclick="languageSelect('flag-arabic')">
        <img id="flag-vietnam" src="images/flag-vietnam.png" alt="Vietnam Flag" data="vi" onclick="languageSelect('flag-vietnam')">
        <img id="flag-india" src="images/flag-india.png" alt="Indian Flag" data="hi" onclick="languageSelect('flag-india')">
        <img id="flag-ethiopia" src="images/flag-ethiopia.png" alt="Ethiopia Flag" data="am" onclick="languageSelect('flag-ethiopia')">
        <img id="flag-bulgaria" src="images/flag-bulgaria.png" alt="Bulgaria Flag" data="bg" onclick="languageSelect('flag-bulgaria')">
        <img id="flag-france" src="images/flag-france.png" alt="France Flag" data="fr" onclick="languageSelect('flag-france')">
        <img id="flag-turkey" src="images/flag-turkey.png" alt="Turkey Flag" data="tr" onclick="languageSelect('flag-turkey')">
    </div>
=======
        <img id ="language-flag" src="" alt="" onclick="languageSelect(id)">
>>>>>>> 90da053368a139fc1e48d55779c5eb0847a304c1
>>>>>>> 8f43469464a8d0d8287e483f1d00a7288f7ac7f7
</div>
</footer>
</html>