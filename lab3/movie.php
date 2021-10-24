<?php
// Getting the movie title from the query pharams of the url 
$movie = $_GET["film"];
?>

<!DOCTYPE html>
<html lang="en">

<!--
    Author: Agostino Messina
    Section: movie.php
-->

<head>
    <title>Rancid Tomatoes</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="movie.css" type="text/css" rel="stylesheet">
    <link href="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/rotten.gif" type="image/gif" rel="shortcut icon">
</head>

<body>
    <div id="header">
        <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
    </div>

    <h1 id="title">
        <?php
        // Opening the file info.txt from the film folder stored in $movie and printing the name and the date of release
        $info = file("$movie/info.txt");
        echo trim($info[0]) . ' (' . trim($info[1]) . ')';
        ?>
    </h1>
    <div id="box">
        <div id="general-overview">
            <div>
                <img src="<?= "$movie/overview.png" ?>" alt="general overview">
            </div>

            <dl>
                <?php
                /*
                Opening the file overview.txt from the film folder stored in $movie, exploding the selected row with the ':' character
                and printing the title of the list and its definition
                */

                $overview = file("$movie/overview.txt");

                for ($i = 0; $i < count($overview); $i++) {
                    $definition = explode(":", $overview[$i]);
                ?>
                    <dt><?= $definition[0] ?></dt>
                    <dd><?= $definition[1] ?></dd>
                <?php
                }
                ?>
            </dl>
        </div>
        <div id="box-reviews">
            <div id="rotten-image">
                <?php
                // chosing and printing the image name based of the percentage value
                if ($info[2] >= 60) {
                    $rotten_img = 'freshbig';
                } else {
                    $rotten_img = 'rottenbig';
                }
                ?>
                <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/<?= $rotten_img ?>.png" alt="Rotten">
                <span id="rating"><?= $info[2] ?>%</span>
            </div>

            <?php
            // getting all the reviews
            $reviews = glob($movie . "/review*.txt");
            $total_reviews = count($reviews);
            ?>
            <div id="left-column">
                <?php
                // printing each publication and review for the left column
                for ($i = 0; $i < ceil($total_reviews / 2); $i++) {
                    $actual_file = file($reviews[$i]);
                ?>
                    <p class="review">
                        <img class="icon" src="<?= 'http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/' . strtolower($actual_file[1]) . '.gif' ?>" alt="<?= $actual_file[1] ?>">
                        <q><?= $actual_file[0] ?></q>
                    </p>
                    <p class="publication">
                        <img class="avatar" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
                        <?= $actual_file[2] ?>
                        <br>

                        <span class="magazine"><?= $actual_file[3] ?></span>
                    </p>
                <?php
                }
                ?>
            </div>
            <div id="right-column">
                <?php
                // printing each publication and review for the right column
                for ($i = ceil($total_reviews / 2); $i < $total_reviews; $i++) {
                    $actual_file = file($reviews[$i]);
                ?>
                    <p class="review">
                        <img class="icon" src="<?= 'http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/' . strtolower($actual_file[1]) . '.gif' ?>" alt="<?= $actual_file[1] ?>">
                        <q><?= $actual_file[0] ?></q>
                    </p>
                    <p class="publication">
                        <img class="avatar" src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
                        <?= $actual_file[2] ?>
                        <br>

                        <span class="magazine"><?= $actual_file[3] ?></span>
                    </p>
                <?php
                }
                ?>
            </div>
        </div>

        <p id="page">(1-<?= $total_reviews ?>) of <?= $total_reviews ?></p>
    </div>
    <div id="validators">
        <p>
            <a href="http://validator.w3.org/check/referer"><img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="Valid HTML5!"></a>
        <p>
            <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"></a>
    </div>
</body>

</html>