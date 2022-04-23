<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donor Registration</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="../assets/style/style.css" type="text/css" />
    <link rel="icon" href="../images/logo.PNG" />
</head>
<body>
<div  class="container">
    <div class="row">
        <div class="col-8 mx-auto mt-5">
            <div class="card mt-5">
                <div class="card-header">
                    <h1 class="text-center">Donor Registration Form</h1>

                    <!-- start php code-->
                    <?php

                    //connect with database
                    require_once '../php/donor_config.php';

                    //check login
                    if(logged_in() === TRUE) {
                        header('location: post.php'); //redirect page
                    }

                    // form is submitted
                    if($_POST) {
                        $fname      = $_POST['fname'];
                        $lname      = $_POST['lname'];
                        $username   = $_POST['username'];
                        $password   = $_POST['password'];
                        $cpassword  = $_POST['cpassword'];
                        $nid       = $_POST['nid'];


                        //check first name is required
                        if($fname == "") {
                            echo "<br/><br/><span class='text-danger'>* First Name is Required</span> <br/>";
                        }

                        //check last name is required
                        if($lname == "") {
                            echo "<span class='text-danger'>* Last Name is Required</span> <br/>";
                        }

                        //check user name is required
                        if($username == "") {
                            echo "<span class='text-danger'>* Email is Required</span> <br/>";
                        }
                        //check password is required
                        if($password == "") {
                            echo "<span class='text-danger'>* Password is Required</span> <br/>";
                        }

                        //check confirm Password is required
                        if($cpassword == "") {
                            echo "<span class='text-danger'>* Confirm Password is Required</span> <br/>";
                        }
                        if($nid == "") {
                            echo "<span class='text-danger'>* NID is Required</span> <br/>";
                        }



                        //check all information..if all information is coorectly input then data will be insert into database. other wise not.
                        if($fname && $lname && $username && $password && $cpassword && $nid) {

                            if($password == $cpassword) {
                                if(userExists($username) === TRUE) {
                                    echo $_POST['username'] . "<span class='text-danger'> already exists !!</span>";
                                } else {
                                    if(registerUser() === TRUE) {
                                        echo "<h1 class='text-success'>Successfully Registered</h1>";
                                    } else {
                                        echo "Error";
                                    }
                                }
                            } else {
                                echo "<span class='text-danger'> * Password does not match with Conform Password</span>";
                            }
                        }

                    }

                    ?>
                    <!-- End  php code-->
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fname">First Name </label>
                            <input type="text" name="fname" placeholder="First Name" autocomplete="off" class="form-control" value="<?php if($_POST) {
                                echo $_POST['fname'];
                            } ?>" />
                        </div>
                        <div  class="form-group">
                            <label for="lname">Last Name: </label>
                            <input type="text" name="lname" placeholder="Last Name" autocomplete="off" class="form-control" value="<?php if($_POST) {
                                echo $_POST['lname'];
                            } ?>" />
                        </div>
                        <div  class="form-group">
                            <label for="username">Email: </label>
                            <input type="email" name="username" placeholder="Email" autocomplete="off" class="form-control" value="<?php if($_POST) {
                                echo $_POST['username'];
                            } ?>" />
                        </div>
                        <div class="form-group">
                            <label for="fname">NID </label>
                            <input type="text" name="nid" placeholder="NID Number" autocomplete="off" class="form-control" value="<?php if($_POST) {
                                echo $_POST['nid'];
                            } ?>" />
                        </div>
                        <div  class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" name="password" placeholder="Password"  class="form-control" autocomplete="off" />
                        </div>
                        <div  class="form-group">
                            <label for="cpassword">Confirm Password: </label>
                            <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div  class="form-group">
                            <button class="btn  btn-success col-4" type="submit">Submit</button>
                            <button class="btn btn-danger col-4" type="reset">Cancel</button>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <p class="float-right">Already Registered ? Click <a href="donor_login.php"><span class="text-info">Login</span></a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>