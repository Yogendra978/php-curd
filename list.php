<?php  
include 'config.php';
include 'header.php';
if(!empty($_SESSION['message'])){
    echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>No Updated :</strong>'.$_SESSION["message"].' You should check in on some of those fields below.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
   
    unset($_SESSION['message']);
   
}elseif(!empty($_SESSION['success'])){
    echo '<div class="alert alert-success" role="alert">
  <h3 class="alert-heading">'.$_SESSION["success"].'</h3>
</div>';
    unset($_SESSION['success']);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All User</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <div class="container ">
    <h1>All Users </h1>
    <hr>
    <h5><a class="btn btn-sm btn-primary" href="main.php">Add User</a></h5>
    <?php
    $sql = "SELECT * FROM `user`";
                $result = mysqli_query($conn,$sql);
                if(!empty(mysqli_num_rows($result))){
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Work</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    while($row=mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                
                <td>
                    <div style="border:1px solid red;height:50px;width:50px;border-radius:100px;">
                        <img src="image/<?php echo $row['profile'];?>" height="50" width="50" style="border-radius:100px;">
                    </div>
                </td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['work'];?></td>
                <td><?php echo $row['desciption'];?></td>
                <td><a class="btn btn-sm btn-warning" href="main.php?id=<?php echo $row['id'];?>">Update</a>&nbsp;&nbsp;
                <a class="btn btn-sm btn-danger" onclick="return onDelete()" href="list.php?id=<?php echo $row['id'];?>">Delete</a></td>
            </tr>
            <?php
                    }
                }else{
                    echo "<h1>Result Not Found!</h1>";
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
<script src="./js/jquery-3.2.1.slim.min.js"></script>
<script src="./js/popper.min.js"></script>
<script>
    function onDelete(){
      return  confirm("Are You Sure Deleting User?");
    }
</script>
</html>
<?php
//insert
if(!empty($_SERVER['REQUEST_METHOD']=='POST')){
    $name = $_POST['name'];
    $email= $_POST['email'];
    $gender = $_POST['gender'];
    $phone= $_POST['phone'];
    $work= $_POST['work'];
    $desc= $_POST['text'];
     
    
    
    if(!empty($_FILES['img']['name'])){
        if($_FILES['img']['size']<1048576){
            $allow = array('jpg','png','jpeg','gif');
             $profile= $_FILES['img']['name'];
            $ext = pathinfo($profile,PATHINFO_EXTENSION);
            if(in_array($ext,$allow)){
              
                $size= $_FILES['img']['size']."<br>";
                $type= $_FILES['img']['type'];
                $temp = $_FILES['img']['tmp_name'];
                $location = "./image/".$profile;
                move_uploaded_file($temp,$location);
            }else{
                $_SESSION['message']="File Type Only jpg,jpeg,png,gif Format Allow!";
                header("Location:main.php");exit;
            }
        }else{
            $_SESSION['message']= "File Size 1mb Allow!";
            header("Location:main.php");exit;
        }
    }else{
        $_SESSION['message']= "File Not Found!";
        header("Location:main.php");exit;
    }

    if(!empty($name) && $name !==""){
        $name = htmlentities($name);
    }else{
        $_SESSION['message']="Please Enter Your Name.";
        header("Location:main.php");
    }

    if(!empty($email) && $email !==""){
        $sql = "SELECT * FROM `user` WHERE email='$email'";
        $result = mysqli_query($conn,$sql);
        $have = mysqli_num_rows($result);
        if(!empty($have !==0)){
            $_SESSION['message'] ="Email Already Exits.";
            header("Location:main.php");exit;
        }
    }else{
        $_SESSION['message']="Please Enter Your Email.";
        header("Location:main.php");exit;
        
    }

    if(!empty($gender) ){
        $gender = htmlentities($gender);
    }else{
        $_SESSION['message'] = "Please Select Gender.";
        header("Location:main.php");exit;
    }

    if(!empty($phone) && $phone !==""){
        $phone = htmlentities($phone);
    }else{
        $_SESSION['message'] = "Please Enter Your Phone.";
        header("Location:main.php");exit;
    }

    if(!empty($work) && $work !=""){
        $work = htmlentities($work);
    }else{
        $_SESSION['message'] = "Please Select Your Work.";
        header("Location:main.php");exit;
    }

    $desc = htmlentities(htmlspecialchars($desc));
 
    $sql =   "INSERT INTO `user`(`profile`,`name`,`email`,`gender`,`phone`,`work`,`desciption`)
     VALUES('$profile','$name','$email','$gender','$phone','$work','$desc') ";
   
     if(!empty(mysqli_query($conn,$sql))){
         $_SESSION['success'] = "User Add Successfully.";
         header("Location:main.php");exit;
     }else{
        $_SESSION['message'] = "Query Failed page list line---177.";
        mysqli_close($conn);
        header("Location:main.php");exit;
     }

    }elseif(!empty($_SERVER['REQUEST_METHOD']=='GET')){
        if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM `user` WHERE `id`='$id'";
        $result = mysqli_query($conn,$sql);
        if($result){
            $_SESSION['success'] ="User Deleted Successfully.";
            header("Location:list.php");
            mysqli_close($conn);
            
        }else{ mysqli_close($conn);
            $_SESSION['message'] = "User Not Deleting.";
            header("Location:list.php");
            mysqli_close($conn);
        }
        }
    }

    ?>