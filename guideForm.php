<?php
    if(isset($_POST["language"])){
        $language = $_POST["language"];
    }else{
        $language = "en"; 
    }
    

    require_once ('vendor/autoload.php');
    use \Statickidz\GoogleTranslate;

    $content["migrant_account__header_text"] = 'Edit Profile';
    $content["migrant_account__title_text"] = 'Guide Profile';
    $content["migrant_account__first_name_text"] = 'First Name:';
    $content["migrant_account__last_name_text"] = 'Last Name:';
    $content["migrant_account__age_text"] = 'Age:';
    $content["migrant_account__gender_text"] = 'Gender:';
    $content["migrant_account__location_text"] = 'Location(City, State):';
    $content["migrant_account__nationality_text"] = 'Nationality:';
    $content["migrant_account__occupation_text"] = 'Occupation:';
    $content["migrant_account__marital_stat_text"] = 'Marital Status:';
    $content["migrant_account__married_button"] = 'Married';
    $content["migrant_account__single_button"] = 'Single';
    $content["migrant_account__family_textarea"] = 'Tell us about your family...';
    $content["migrant_account__language_textarea"] = 'What languages do you speak...';
    $content["migrant_account__hobby_text"] = 'Hobby:';
    $content["migrant_account__picture_text"] = 'Insert a Picture:';


    $trans = new GoogleTranslate();
    $migrant_account__header_text = $trans->translate("en", $language, $migrant_account__header_text);
    $migrant_account__title_text = $trans->translate("en", $language, $migrant_account__title_text);
    $migrant_account__first_name_text = $trans->translate("en", $language,  $migrant_account__first_name_text);
    $migrant_account__last_name_text = $trans->translate("en", $language,  $migrant_account__last_name_text);
    $migrant_account__age_text = $trans->translate("en", $language, $migrant_account__age_text);
    $migrant_account__gender_text = $trans->translate("en", $language, $migrant_account__gender_text);
    $migrant_account__location_text = $trans->translate("en", $language,  $migrant_account__location_text);
    $migrant_account__nationality_text = $trans->translate("en", $language,  $migrant_account__nationality_text);
    $migrant_account__occupation_text = $trans->translate("en", $language, $migrant_account__occupation_text);
    $migrant_account__marital_stat_text = $trans->translate("en", $language, $migrant_account__marital_stat_text);
    $migrant_account__married_button = $trans->translate("en", $language,  $migrant_account__married_button);
    $migrant_account__single_button = $trans->translate("en", $language, $migrant_account__single_button);
    $migrant_account__family_textarea = $trans->translate("en", $language, $migrant_account__family_textarea);
    $migrant_account__language_textarea = $trans->translate("en", $language, $migrant_account__language_textarea);
    $migrant_account__hobby_text= $trans->translate("en", $language,  $migrant_account__hobby_textarea);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title><?php echo $migrant_account__title_text; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>

<body>

<header>
    <div class="title"><?php echo $migrant_account__header_text; ?></div>
</header>

<main>
    <div class="content">
        <form action="browse.php" method="post">
        <?php echo $migrant_account__first_name_text; ?><input type="text" name="fname"><br>
        <?php echo  $migrant_account__last_name_text; ?><input type="text" name="lname"><br>
        <?php echo $migrant_account__age_text; ?><input type="text" name="age"><br>
        <?php echo $migrant_account__gender_text; ?><input type="text" name="gender"><br>
        <?php echo $migrant_account__location_text; ?><input type="text" name="location"><br>
        <?php echo $migrant_account__nationality_text; ?><input type="text" name="nationality"><br>
        <?php echo $migrant_account__occupation_text; ?><input type="text" name="occupation"><br>

        <?php echo $migrant_account__marital_stat_text; ?>
            <input type="radio" name="maritalStat" value="married"><?php echo $migrant_account__married_button; ?>
            <input type="radio" name="maritalStat" value="single"> <?php echo $migrant_account__single_button;?><br>

        <?php echo $migrant_account__hobby_text; ?><input type="text" name="hobby1"><br>
        <?php echo $migrant_account__hobby_text; ?><input type="text" name="hobby2"><br>

       
        <textarea rows="6" cols="50" name="family"><?php echo $migrant_account__family_textarea; ?></textarea><br>
        <textarea rows="4" cols="50" name="languages"><?php echo $migrant_account__language_textarea; ?></textarea><br>
        
        <?php echo $migrant_account__picture_text; ?><input type="file" name="pic1" accept="image/*"><br>
        <?php echo $migrant_account__picture_text; ?><input type="file" name="pic2" accept="image/*"><br>
        <?php echo $migrant_account__picture_text; ?><input type="file" name="pic3" accept="image/*"><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</main>

</body>
</html>