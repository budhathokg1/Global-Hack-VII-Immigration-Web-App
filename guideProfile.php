<?php
    require_once 'functions/functions.php';
    require_once 'include/db_connect.php';
    if(isset($_POST["language"])){
        $language = $_POST["language"];
    }else{
        $language = "en"; 
    }
    

    require_once ('vendor/autoload.php');
    use \Statickidz\GoogleTranslate;

    $content["migrant_account__header_text"] = 'Create Profile';
    $content["migrant_account__title_text"] = 'Guide Profile';
    $content["migrant_account__edit_text"] = 'edit';
    $content["migrant_account__personal_text"] = 'personal information';

    $content["migrant_account__first_name_text"] = 'First Name:';
    $content["migrant_account__last_name_text"] = 'Last Name:';
    $content["migrant_account__age_text"] = 'Age:';
    $content["migrant_account__gender_text"] = 'Gender:';

    $content["migrant_account__location_state"] = 'State:';
    $content["migrant_account__location_city"] = 'City:';
    $content["migrant_account__nationality_text"] = 'Nationality:';
    $content["migrant_account__religion_text"] = 'Religion:';
    $content["migrant_account__occupation_text"] = 'Occupation:';

    $content["migrant_account__marital_stat_text"] = 'Relationship Status:';
    $content["migrant_account__select_select"] = 'Select';
    $content["migrant_account__married_select"] = 'Married';
    $content["migrant_account__single_select"] = 'Single';
    $content["migrant_account__complicated_select"] = 'It\'s Complicated';
    $content["migrant_account__other_select"] = 'Other';

    $content["migrant_account__self_textarea"] = 'Tell us about yourself...';
    $content["migrant_account__family_textarea"] = 'Tell us about your family...';

    $content["migrant_account__language_text"] = 'Language';
    $content["migrant_account__primary_language_text"] = 'Primary Language';
    $content["migrant_account__secondary_language_text"] = 'Secondary Language';

    $content["migrant_account__hobby_text"] = 'Hobby:';
    $content["migrant_account__picture_text"] = 'Insert a Picture:';
    $content["migrant_account__must_complete"] = 'you must complete these fields';


    $trans = new GoogleTranslate();
    foreach($content as $key => $text){
        $content["$key"] = $trans->translate("en", $language, $text);
    }

    $guides = get_guides($conn);
    print_r($guides);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title><?php echo $content["migrant_account__title_text"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>
    <style>
        .box-container {
            background-color: white;
            margin-bottom: 25px;
            margin: auto;
            margin-top: 15px;
            width: 50%;
            box-shadow: 0px 0px 15px lightgray;
        }
        .divider {
            width: 50%;
            margin: 0 auto;
        }
        .input-picture {
            margin: 0 auto;
            height: 50px;
            width: 50px;
            background-color: lightgray;
            border-radius: 50px;
            margin-bottom: 50px;
        }
        .card-row-header input {
            border: none;
            background-color: #fff;
            padding: 0px;
            color: black;
            font-weight: 700;
            width: 100%;
        }
        .card-row-header select {
            border: none;
            background-color: #fff;
            padding: 0px;
            color: black;
            font-weight: 700;
            width: 100%;
        }
        .card-row-header textarea {
            border: 1px solid lightgray;
            resize: none;
            border-radius: 5px;
            width: 100%;
        }
        .card-row-header textarea::placeholder {
            font-family: 'Open Sans', sans-serif;
            text-transform: lowercase;
            color: gray;
        }
        .card-row-header .input-photo {
            width: 33.33%;
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
            color: black;
        }
        .card-field {
            flex-grow: 1;
            margin: 0px auto 10px auto;
            width: 33.33%;
        }
        .input-header {
            background-image: url("images/map.jpg");
            background-size: cover;
            height: 100px;
        }
        .red {
            color: #cc0000;
        }
        #input-save {
            padding: 10px;
            width: 100%;
            border: none;
            transition: 0.3s ease-in-out;
            font-size: 13px;
            color: gray;
            height: 50px;
        }
        #input-save:hover {
            background-color: lightgray;
            color: black;
        }
    </style>
<body>

<header>
    <div class="title"><?php echo $content["migrant_account__header_text"]; ?></div>
</header>

<main>
    <div class="divider">
        <div class="grade"><?php echo $content["migrant_account__edit_text"]; ?></div>
        <div class="date"><?php echo $content["migrant_account__personal_text"]; ?></div>
    </div>

    <div class="box-container">
        <form action="browse.php" method="post">
        <?php  foreach($guides as $person){
        ?>
            <div class="input-header"></div>
        <div class="card-row-header" style="margin-bottom: 0px;">
            <div class="input-picture"><img src=""></div>
        </div>
        <div class="card-row-header">
            <div class="card-field"><input required type="text" name="fname" placeholder="<?php echo $person->user_first_name; ?>"><br><?php echo strtolower($content["migrant_account__first_name_text"]); ?><span class="red">*</span></input></div>
            <div class="card-field"><input required type="text" name="lname" placeholder="<?php echo $person->user_last_name; ?>"><br><?php echo strtolower($content["migrant_account__last_name_text"]); ?><span class="red">*</span></input></div>
            <div class="card-field"><input type="text" name="gender" placeholder="<?php echo $person->gender; ?>"><br><?php echo strtolower($content["migrant_account__gender_text"]); ?></input></div>
        </div>
        <div class="card-row-header">
            <div class="card-field"><input required type="text" name="nationality" placeholder="<?php echo $person->nationality; ?>"><br><?php echo strtolower($content["migrant_account__nationality_text"]); ?><span class="red">*</span></input></div>
            <div class="card-field"><input type="text" name="Religion"placeholder="<?php echo $person->religion; ?>"><br><?php echo strtolower($content["migrant_account__religion_text"]); ?></input></div>
            <div class="card-field">
            <select>
                <option value = "Select"> <?php echo $content["migrant_account__select_select"]; ?></option>
                <option value="married"><?php echo $content["migrant_account__married_select"]; ?></option>
                <option value="Single"><?php echo $content["migrant_account__single_select"]; ?></option>
                <option value="complicated"><?php echo $content["migrant_account__complicated_select"]; ?></option>
                <option value="Other"><?php echo $content["migrant_account__other_select"]; ?></option>
            </select>
            <br>maritial status</div>
        </div>
        <div class="card-row-header">
            <div class="card-field"><input required type="text" name="location"placeholder="<?php echo $person->city;?>"><br><?php echo strtolower($content["migrant_account__location_city_text"]); ?><span class="red">*</span></input></div>
            <div class="card-field"><input required type="text" name="location"placeholder="<?php echo $person->state;?>"><br><?php echo strtolower($content["migrant_account__location_state_text"]); ?><span class="red">*</span></input></div>
            <div class="card-field"><input style="scroll: hidden;" required type="number" min="1" name="age" placeholder="<?php echo $person->age; ?>"><br><?php echo strtolower($content["migrant_account__age_text"]); ?><span class="red">*</span></input></div>
        </div>
        <div class="card-row-header">
            <div class="card-field"><input required style="width: 50%;" type="text" name="primary_language" placeholder="<?php echo $person->primary_language; ?>"><br><?php echo strtolower($content["migrant_account__primary_language_text"]); ?><span class="red">*</span></input></div>
            <div class="card-field"><input style="width: 50%;" type="text" name="secondary_language" placeholder="<?php echo $content["migrant_account__language_text"]; ?>"><br><?php echo strtolower($content["migrant_account__secondary_language_text"]); ?></input></div>
        </div>
        <div class="card-row-header">
            <div class="card-field"><input style="width: 50%;" type="text" name="hobby1" placeholder="<?php echo $content["migrant_account__hobby_text"];?>"><br><?php echo strtolower($content["migrant_account__hobby_text"]); ?></input></div>
            <div class="card-field"><input style="width: 50%;" type="text" name="hobby2" placeholder="<?php echo $content["migrant_account__hobby_text"]; ?>"><br><?php echo strtolower($content["migrant_account__hobby_text"]); ?></input></div>
        </div>
        <div class="card-row-header">
            <textarea rows="4" cols="50" name="self" placeholder="<?php echo $person->self_desc; ?>"></textarea>
        </div>
        <div class="card-row-header">
            <textarea required rows="4" cols="50" name="family" placeholder="<?php echo $content["migrant_account__family_textarea"]; ?>"></textarea>
        </div>
        <div class="card-row-header" style="color: black;"><?php echo strtolower($content["migrant_account__must_complete"]); ?><span class="red">*</span></div>
        <div class="card-row-header">
            <?php echo $content["migrant_account__picture_text"]; ?>
            <input class="input-photo" type="file" name="pic1" accept="image/*">
            <input class="input-photo" type="file" name="pic2" accept="image/*">
            <input class="input-photo"type="file" name="pic3" accept="image/*">
        </div>
        <?php      
        }?>
            <input id="input-save" type="submit" value="save changes">
        </form>
    </div>
</main>

</body>
</html>