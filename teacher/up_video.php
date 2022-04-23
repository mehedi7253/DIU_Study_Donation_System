<?php


//connect with database
require_once '../php/teacher_config.php';
// check user login via session
if(not_logged_in() === TRUE) {
    header('location: teacher_login.php'); // redirect location
}

$userdata = getUserDataByUserId($_SESSION['id']);  //get all information by user id


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Martial Upload</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css" type="text/css"/>
    <link rel="icon" href="../images/<?php echo $userdata['image'];?>"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
<!--Start menu section-->
<?php include 'nav_bar.php'?>
<!--end menu section-->
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 mt-5 mb-5">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="col-sm-12 col-md-4 float-left">
                        <div class="card">
                            <div class="card-header">
                                <p class="text-center">Chose One</p>
                            </div>
                            <div class="card-body">
                                <label class="text-center"><a class="nav-link" href="file_upload.php"><i class="fas fa-upload"></i><span class="ml-3">File Upload</span></a></label><br/>
                                <label class="text-center"><a class="nav-link" href="up_video.php"><i class="fas fa-play-circle" style="color: #cce5ff;"></i><span class="ml-3"> Upload Curse Video</span></a></label>
                                <label class="text-center"><a class="nav-link" href="view.php"><i class="fas fa-eye" style="color: green"></i><span class="ml-3">View Upload File</span></a></label>
                                <label class="text-center"><a class="nav-link" href="view_video.php"><i class="fas fa-eye" style="color: green"></i><span class="ml-3">View Curse Video</span></a></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 float-left">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="text-center">Course Video Upload</h1>
                                <br/>
                                <?php
                                //print_r ($_FILES['file']);
                                if(isset($_FILES['file'])){
                                    $teacherID = $_POST['teacherID'];
                                    $fcname = $_POST['fcname'];
                                    $subject =$_POST['subject'];

                                    $name = $_FILES['file']['name'];
                                    $extension = explode('.', $name);
                                    $extension = end($extension);
                                    $type = $_FILES['file']['type'];
                                    $size = $_FILES['file']['size'] /1024/1024;
                                    $random_name = rand();
                                    $tmp = $_FILES['file']['tmp_name'];


                                    if($size >= 15971520)
                                    {
                                        $message="File must not greater than 15mb";
                                    }else
                                    {
                                        move_uploaded_file($tmp, "uploads/".$random_name.'.'.$extension);
                                        mysqli_query($connect, "INSERT INTO curse_video(teacherID, fcname, subject, name,url) 
					VALUES('$teacherID', '$fcname', '$subject', '$name', '$random_name.$extension')");
                                        $message="<span class='text-success'>Video has been successfully uploaded !</span>";
                                    }
                                    echo "$message <br/> <br/>";
                                    echo "size: $size mb<br/>";
                                    echo "random_name: $random_name <br/>";
                                    echo "name: $name <br/>";
                                    echo "type: $type <br/><br/>";
                                }

                                ?>

                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label>Teacher Name</label>
                                        <input type="text" name="teacherID" hidden class="form-control" value="<?php echo $userdata['id'];?>">
                                        <input type="text" name="fcname"  class="form-control" value="<?php echo $userdata['first_name'];?> <?php echo $userdata['last_name'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Course</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="subject">
                                            <option selected>------Select Course---------</option>
                                            <P>
                                                <?php
                                                $sql = "SELECT * FROM course";
                                                $result = mysqli_query($connect, $sql);
                                                ?>
                                            </P>
                                            <?php while ($row = mysqli_fetch_assoc($result)){?>
                                                <option value="<?php echo $row['course_name'];?>"><?php echo $row['course_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Video</label>
                                        <input name="UPLOAD_MAX_FILESIZE" value="20971520"  type="hidden"/>
                                        <input type="file" name="file" id="file" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="file" class="btn ml-5 col-9 btn-info">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="footer-text col-md-12 col-sm-12">
                <p class="text-white text-capitalize text-center font-italic p-4">Create By  <strong>@Md.Mehedi Hasan</strong></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>