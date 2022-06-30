<?php

/**
 * Configuration
 *
 */
$file = __DIR__ . "/wishlist.json";

/**
 * Application
 *
 */

$fileContent = file_get_contents($file);
$wishes = json_decode($fileContent);

if(isset($_POST["id"])){
    $wishes[$_POST["id"]]->marked = $_POST["state"];
    file_put_contents($file, json_encode($wishes));
    header("Location: ./");
}

?>
    <!doctype html>

    <html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wunschliste</title>
        <meta name="description" content="Weil immer alle Fragen ;)">
        <meta name="author" content="Marius Bonifer">

        <meta property="og:title" content="Wunschliste">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://wishlist.mariusbonifer.de/">
        <meta property="og:description" content="Weil immer alle Fragen.">
        <meta property="og:image" content="image.png">

        <link rel="icon" href="/favicon.ico">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="stylesheet" href="style.css?v=1.0">

    </head>

    <body>
    <h1>Wunschliste</h1>
    <h2>Marius Bonifer</h2>
    <div class="wishes">

<?php


foreach ($wishes as $key => $wish){
    $id = $key;
    $name = $wish->name;
    $image = $wish->image;
    $details = $wish->details;
    $link = $wish->link;
    $color = $wish->marked === "true" ? "marked" : "";
    $marked = $wish->marked === "true" ? "selected" : "";

    echo "
        <div class='wish $color'>
            <div class='thumbnail'>
                <img src='$image' alt='$name' />
            </div>
            <div class='desc'> 
                <h3>$name</h3>
                <p>$details</p><br>
                <form action='./' method='post'>
                    <input type='hidden' name='id' value='$id'>
                    Status: 
                    <select name='state' onchange='this.form.submit()'>
                        <option value='false'>Frei</option>
                        <option value='true' $marked>Vorgemerkt</option>
                    </select>
                   
                </form> 
                <a href='$link' ><p class='button'>Ansehen</p></a>
            </div>
        </div>
    ";
}
?>
    </div>
    <script src="js/scripts.js"></script>
    </body>
    </html>
