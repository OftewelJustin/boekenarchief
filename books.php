
<?php

if (isset($_POST['event_uploader'])){

    $conn = mysqli_connect("localhost", "root", "", "boekenarchief"); //Connect to database

    $booktitle = $_POST['booktitle'];
    $userid = $_POST['userid'];
    $bookid = $_POST['bookid'];
    $dt1 = new DateTime();
    $today = $dt1->format("Y-m-d");

    $dt2 = new DateTime("+1 month");
    $date = $dt2->format("Y-m-d");


    $sql = "INSERT INTO spend (iduser, idbook, date, fourweeks, title) VALUES ('$userid', '$bookid', '$today', '$date', '$booktitle') ";
    //$query  = "UPDATE `books` SET borrow='0' WHERE id='$bookid'";
    $query = mysqli_query($conn, $sql);
    echo mysqli_error($conn);


}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

    <title>Hello, world!</title>
</head>

<body>
    <?php
    require ('./php/Navbar.php');

    ?>


    <!-- Page Content -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <?php

                // Initialize the session
                session_start();

                require ('cms/core/Assets/Config.php');


                $conn = mysqli_connect("localhost", "root", "", "boekenarchief"); //Connect to database

                $id = $_GET['id'];
                $query = "SELECT * FROM books WHERE id=$id";
                $result = mysqli_query($conn, $query) or die('Cannot fetch data from database. '.mysqli_error($conn));
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {?>
                        <div class="col-md-9">
                            <div class="small mb-1">BOOK ID: <?php echo $row['id'] ?></div>
                            <h1 class="display-5 fw-bolder"><?php echo $row['title'] ?></h1>
                            <div class="fs-5 mb-5">
                                <span class="text-decoration-line-through">
                                    <?php
                                    if($row['borrow'] == 1){
                                        ?>
                                        <p class="text-success">Available</p>
                                        <?php
                                    } else if($row['borrow'] == 0) {
                                        ?>
                                        <p class="text-danger">Not Available</p>

                                        <?php
                                    }
                                    ?>
                                </span>
                           </div>
                            <p class="lead"><?php echo $row['author'] ?></p>
                            <?php
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                if($row['borrow'] == 1) {
                                        ?>
                                            <div class="d-flex">
                                                <form action="books.php" method="POST">
                                                    <input type="hidden" name="userid" name="$userid" value="<?php echo $_SESSION['id']?>">
                                                    <input type="hidden" name="bookid" name="bookid" value="<?php echo $_GET['id']?>">
                                                    <input type="hidden" name="booktitle" name="booktitle" value="<?php echo $row['title'] ?>">
                                                    <input  class="btn bg-success text-white flex-shrink-0" type="submit" name="event_uploader" value="Claim">
                                                </form>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                <?php
                            } else {
                                ?>
                                <div class="d-flex">
                                    <a class="btn bg-danger text-white flex-shrink-0" href="cms/register.php" type="button">
                                        <i class="bi-cart-fill me-1"></i>
                                        First Sign In
                                    </a>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <?php
                    }
                }
                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>