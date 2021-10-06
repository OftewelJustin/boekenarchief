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

    <!-- Full Page Image Header with Vertically Centered Content -->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 class="fw-light">BookTastic</h1>
                    <p class="lead">You need some books?</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-light">Reserve Books</h2>
            <div class="row">
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "boekenarchief"); //Connect to database
                        $query = "SELECT * FROM `books` WHERE `borrow` = 1 LIMIT 6";
                        $result = mysqli_query($conn, $query) or die('Cannot fetch data from database. ' . mysqli_error($conn));
                        while ($row = mysqli_fetch_assoc($result)) {?>
                        <div class="col">
                            <div class="card mt-5" style="width: 21em; height: 15em;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['author']; ?></h6>
                                    <p class="card-text"><?php echo $row['publisher']; ?></p>
                                    <a  href="books.php?id=<?php echo $row['id'] ?> " class="btn btn-primary" >Reserve Now!</a>
                                </div>
                            </div>
                        </div>

                    <?php
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