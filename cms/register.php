<?php

require ('./core/Assets/Config.php');

if( isset($_POST['submit']) ) {
    $firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
    $lastname = mysqli_real_escape_string($con, trim($_POST['lastname']));
    $mail = mysqli_real_escape_string($con, trim($_POST['mail']));
    $username = mysqli_real_escape_string($con, trim($_POST['username']));
    $password  = mysqli_real_escape_string($con, trim($_POST['password']));

    // Keep track of validated values
    $valid = array('firstname'=>false, 'lastname'=>false, 'mail'=>false, 'username'=>false, 'password'=>false);
    // Validate firstname
    if( !empty($firstname) ) {
        if( strlen($firstname) >= 2 && strlen($firstname) <= 40 ) {
            if( !preg_match('/[^a-zA-Z\s]/', $firstname) ) {
                $valid['firstname'] = true;
                echo 'Firstname is OK! <br/>';
            }else{
                echo 'Firstname can contain only letters!<br/>';
            }
        }else{
            echo 'Firstname must be between 2 and 40 characters long!<br/>';
        }
    }else{
        echo 'Firstname cannot be blank!<br/>';
    }
    // Validate lastname
    if( !empty($lastname) ) {
        if( strlen($lastname) >= 2 && strlen($lastname) <= 40 ) {
            if( !preg_match('/[^a-zA-Z\s]/', $lastname) ) {
                $valid['lastname'] = true;
                echo 'Lastname is OK! <br/>';
            }else{
                echo 'Lastname can contain only letters!<br/>';
            }
        }else{
            echo 'Lastname must be between 2 and 40 characters long!<br/>';
        }
    }else{
        echo 'Lastname cannot be blank!<br/>';
    }
    // Validate email
    if( !empty($mail) ) {
        if( filter_var($mail, FILTER_VALIDATE_EMAIL) ) {
            $valid['mail'] = true;
            echo 'E-mail is OK!<br/>';
        }else{
            echo 'E-mail is invalid!<br/>';
        }
    }else{
        echo 'E-mail cannot be blank!<br/>';
    }
    // Validate username
    if( !empty($username) ) {
        if( strlen($username) >= 2 && strlen($username) <= 16 ) {
            if( !preg_match('/[^a-zA-Z\d_.]/', $username) ) {
                $valid['username'] = true;
                echo 'Username is OK! <br/>';
            }else{
                echo 'Username can contain only letters!<br/>';
            }
        }else{
            echo 'Username must be between 2 and 16 characters long!<br/>';
        }
    }else{
        echo 'Username cannot be blank!<br/>';
    }
    // Validate password
    if( !empty($password) ) {
        if( strlen($password) >= 5 && strlen($password) <= 32 ) {
            $valid['password'] = true;
            $password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>8]);
            echo 'Password is OK!<br/>';
        }else{
            echo 'Password must be between 5 and 32 characters!<br/>';
        }
    }else{
        echo 'Password cannot be blank!<br/>';
    }
    if($valid['firstname'] && $valid['lastname'] && $valid['mail'] && $valid['username'] && $valid['password']) {
        $query = "INSERT INTO `users` (`firstname`, `lastname`, `mail`, `username`, `password`) VALUES ('$firstname','$lastname','$mail','$username','$password')";
        $result = mysqli_query($con, $query) or die('Cannot insert data into database. '.mysqli_error($con));
        if($result) {
            echo 'Data inserted into database.';
            $user   = mysqli_close($con);
            header("location: ./index.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="register.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="mail" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Add">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>