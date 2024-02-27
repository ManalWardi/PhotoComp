<?php


try {
    $db = new PDO("mysql:host=localhost;dbname=Competition","root","");
    // Définir le mode d'erreur de PDO à Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    }
if (isset($_GET['idPar'])) {
    $idPar = $_GET['idPar'];
} else {
    $idPar = '';
    header('location:posts_publiques.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view post</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- header section starts  -->
    <?php include 'header.php'; ?>
    <!-- header section ends -->

    <!-- view posts section starts  -->

    <section class="view-post">

        <div class="heading">
            <h1>post details</h1> <a href="posts_publiques.php" class="inline-option-btn"
                style="margin-top: 0;">all posts</a>
        </div>

        <?php
        $select_post = $db->prepare("SELECT * FROM `participant` WHERE idPar = ? LIMIT 1");
        $select_post->execute([$idPar]);
        if ($select_post->rowCount() > 0) {
            while ($fetch_post = $select_post->fetch(PDO::FETCH_ASSOC)) {

                $total_ratings = 0;
                $rating_1 = 0;
                $rating_2 = 0;
                $rating_3 = 0;
                $rating_4 = 0;
                $rating_5 = 0;

                $select_ratings = $db->prepare("SELECT * FROM `review` WHERE idPar = ?");
                $select_ratings->execute([$fetch_post['idPar']]);
                $total_reivews = $select_ratings->rowCount();
                while ($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)) {
                    $total_ratings += $fetch_rating['rating'];
                    if ($fetch_rating['rating'] == 1) {
                        $rating_1 += $fetch_rating['rating'];
                    }
                    if ($fetch_rating['rating'] == 2) {
                        $rating_2 += $fetch_rating['rating'];
                    }
                    if ($fetch_rating['rating'] == 3) {
                        $rating_3 += $fetch_rating['rating'];
                    }
                    if ($fetch_rating['rating'] == 4) {
                        $rating_4 += $fetch_rating['rating'];
                    }
                    if ($fetch_rating['rating'] == 5) {
                        $rating_5 += $fetch_rating['rating'];
                    }
                }

                if ($total_reivews != 0) {
                    $average = round($total_ratings / $total_reivews, 1);
                    $select_post = $db->prepare("UPDATE `participant` SET `note`=$average WHERE idPar = ? ");
                    $select_post->execute([$idPar]);

                } else {
                    $average = 0;
                }

        ?>
        <div class="row">
            <div class="col">
                <img src="uploaded_files1/<?= $fetch_post['image']; ?>" alt="" class="image">
                <h3 class="title"><?= $fetch_post['titre']; ?></h3>
            </div>
            <div class="col">
                <div class="flex">
                    <div class="total-reviews">
                        <h3><?= $average; ?><i class="fas fa-star"></i></h3>
                        <p><?= $total_reivews; ?> reviews</p>
                    </div>
                    <div class="total-ratings">
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span><?= $rating_5; ?></span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span><?= $rating_4; ?></span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span><?= $rating_3; ?></span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span><?= $rating_2; ?></span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <span><?= $rating_1; ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">post is missing!</p>';
        }
        ?>

    </section>

    <!-- view posts section ends -->

    <!-- reviews section starts  -->

    <section class="reviews-container">

        <div class="heading">
            <h1>user's reviews</h1> 
        </div>

        <div class="box-container">

            <?php
          


            $select_reviews = $db->prepare("SELECT * FROM `review` WHERE idPar = ?");
            $select_reviews->execute([$idPar]);
            if ($select_reviews->rowCount() > 0) {
                while ($fetch_review = $select_reviews->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="box" >
                <?php
                        $select_jury = $db->prepare("SELECT * FROM `jury` WHERE idJury = ?");
                        $select_jury->execute([$fetch_review['idJury']]);
                        while ($fetch_jury = $select_jury->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                     <div class="user">  
                    <h3><?= substr($fetch_jury['prenomJury'], 0, 1); ?></h3>  
                        <div>

                        <p><?= $fetch_jury['prenomJury']; ?></p>
                    </div>
                </div>
                <?php }; ?>
                <div class="ratings">
                    <?php if ($fetch_review['rating'] == 1) { ?>
                    <p style="background:var(--red);"><i class="fas fa-star"></i>
                        <span><?= $fetch_review['rating']; ?></span></p>
                    <?php }; ?>
                    <?php if ($fetch_review['rating'] == 2) { ?>
                    <p style="background:var(--orange);"><i class="fas fa-star"></i>
                        <span><?= $fetch_review['rating']; ?></span></p>
                    <?php }; ?>
                    <?php if ($fetch_review['rating'] == 3) { ?>
                    <p style="background:var(--orange);"><i class="fas fa-star"></i>
                        <span><?= $fetch_review['rating']; ?></span></p>
                    <?php }; ?>
                    <?php if ($fetch_review['rating'] == 4) { ?>
                    <p style="background:var(--main-color);"><i class="fas fa-star"></i>
                        <span><?= $fetch_review['rating']; ?></span></p>
                    <?php }; ?>
                    <?php if ($fetch_review['rating'] == 5) { ?>
                    <p style="background:var(--main-color);"><i class="fas fa-star"></i>
                        <span><?= $fetch_review['rating']; ?></span></p>
                    <?php }; ?>
                </div>
                <h3 class="title"><?= $fetch_review['title']; ?></h3>
                <?php if ($fetch_review['descrp'] != '') { ?>
                <p class="description"><?= $fetch_review['descrp']; ?></p>
                <?php }; ?>
                
            </div>
            <?php
                }
            } else {
                echo '<p class="empty">no reviews added yet!</p>';
            }
            ?>

        </div>

    </section>

    <!-- reviews section ends -->













    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link  -->
    <script src="script.js"></script>

    <?php include 'alers.php'; ?>

</body>

</html>
