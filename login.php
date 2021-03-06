<?php

    require_once 'include/db_connect.php';
    $email = $password = "";
    $emailErr = $passwordErr = "";

    $content["login__err_valid_email"] = "enter a valid email";
    $content["login__err_incorrect_password"] = "incorrect password";
    $content["login__err_valid_password"] = "The password you entered was not valid.";
    $content["login__err_no_account_email"] = "No account found with that email.";
    $content["login__err_oops"] = "Oops! Something went wrong. Please try again later.";


    if(isset($_POST['login_submit'])){
        // Check if username is empty
        if(empty(trim($_POST["email"]))){
            $emailErr = $content["login__err_valid_email"];
        } else{
            $email = trim($_POST["email"]);
        }

        // Check if password is empty
        if(empty(trim($_POST['password']))){
            $passwordErr = $content["login__err_incorrect_password"];
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
                                $passwordErr = $content["login__err_no_account_email"];
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $emailErr = $content["login__err_no_account_email"];
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
    $content["login__grade_sign_up"] = "sign up";
    $content["login__sign_in_account"]="If you have previously created a profile and are a registered guide, please sign in below";
    $content["login__login_general_use_description"]= "This website will allow you to either help guide an immagrant family or if you are an immagrant family you can find a resdient family to help make your transtion to your new home smoother. we ensure a smooth and safe transition into your new friendship family, so don't worry, your information is confidential and secure";
    $content["login__sign_in_header_text_bold"]= "choose";
    $content["login__login"] = "Login";
    $content["login__create_account_button"]= "Create Account";
    $content["login__sign_in_header_text"]= "your account";
    $content["login__sign_in_button"]= "sign in";
    $content["login__create_account"]="If you are new to this website, click the button below to get started on your personal profile and become one step closer to finding your future friendship family";

    $content["login__grade_log_in"] = "log in";
    $content["login__log_personal_acct"] = "personal account";

    $content["login__email"] = "email";
    $content["login__password"] = "password";

    $content["login__grade_sign_up"] = "sign up";
    $content["login__sign_personal_acct"] = "personal account";

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
    <style>
        .box-container {
            background-color: white;
            margin-bottom: 25px;
            margin: auto;
            margin-top: 10px;
            width: 50%;
            box-shadow: 0px 0px 15px lightgray;
        }
        .card-row-header {
            font-size: 13px;
            color: gray;
            margin-bottom: 25px;
            overflow: auto;
            padding: 0px 20px;
            display: flex;
            flex-wrap: wrap;
            text-align: center;
            text-align-last: center;
        }
        .card-row-header input::placeholder {
            font-family: 'Open Sans', sans-serif;
            text-transform: uppercase;
            color: lightgray;
        }
        .card-field {
            margin: 0 auto;
            padding-bottom: 20px;
            width: 33.33%;
            flex-grow: 1;
        }
        .card-row-header input {
            border: none;
            background-color: #fff;
            padding: 0px;
            color: black;
            font-weight: 700;
            width: 100%;
        }
        .divider {
            width: 50%;
            margin: 0 auto;
        }
        button {
            cursor: pointer;
        }
        button:focus {
            outline: 0;
        }
    </style>
    </head>

<body>

<header>
    <nav>
        <ul>
            <li style="float: left; font-size: 20px;"><a href="index.php"><b>Jump</b>Start</a></li>
            <li style="float: right; font-size: 20px;"><a href=""><i class="fas fa-map-marked-alt"></i></a></li>
            <li style="float: right; font-size: 20px;"><a href="browse.php"><i class="fas fa-list"></i></a></li>
            <li style="float: right; font-size: 20px;" class="dropdown"><a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-cog"></i></a>
            <div class="dropdown-content">
                <a href="#">Account</a>
                <a href="#">Sign Out</a>
            </div>
        </li>
        </ul>
    </nav>

    <div class="title"><b><?php echo  $content["login__sign_in_header_text_bold"]; ?></b> <?php echo $content["login__sign_in_header_text"]; ?></div>
    <div class="sub-title"><?php echo  $content["login__login_general_use_description"]; ?></div>
</header>

<main>
        <div class="divider">
            <div class="grade"><?php echo  $content["login__grade_log_in"]; ?></div>
            <div class="date"><?php echo  $content["login__log_personal_acct"]; ?></div>
        </div>

        <div class="box-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="card-row-header" style="padding-top: 20px;">
                    <div class="card-field"><input id ="input-user" type="text" name="email" placeholder="johnsmith@gmail.com"><?php echo $emailErr; ?><br><?php echo  $content["login__email"]; ?></div>
                    <div class="card-field"><input id="input-lock" type="password" name="password" placeholder="●●●●●●●●●●●"><?php echo $passwordErr; ?><br><?php echo  $content["login__password"]; ?></div>
                </div>
                <div class="card-row-header">
                    <div class="card-field"><button type="submit" name="login_submit"><?php echo $content["login__sign_in_button"]; ?></button></div>
                </div>

        </form>
    </div>

    <div class="divider">
        <div class="grade"><?php echo  $content["login__grade_sign_up"]; ?></div>
        <div class="date"><?php echo  $content["login__sign_personal_acct"]; ?></div>
    </div>
    <div class="box-container">
        <div class="card-row-header" style="padding-top: 20px;">
            <div class="card-field"><?php echo $content["login__create_account"]; ?></div>
        </div>
        <div class="card-row-header">
            <div class="card-field"> <a href="signup.php"><button><?php echo $content["login__create_account_button"]; ?></button></a></div>
        </div>
    </div>

</main>

</body>
<footer>
    <div id="language-footer">
        <div id = "language-display" class="languages"><script>displayLanguage('<?php echo $language?>');</script></div>
        <img id ="language-flag" src="" alt="" onclick="languageSelect(id)">
</div>
</footer>
</html>