<?php
include 'config.php';
include 'header.php';
if(!empty($_SESSION['message'])){
    echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>No Inserted:</strong>'.$_SESSION["message"].' You should check in on some of those fields below.
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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <?php
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `user` WHERE `id`=$id";
        $result =mysqli_query($conn,$sql);
        if(!empty($result)){
            while($row=mysqli_fetch_assoc($result)){
        ?>
        <title>update Users</title>
        </head>
        <body>
        <div class="container">
        <h1>Update Users</h1>
        <hr>
        <h5><a class="btn btn-sm btn-primary" href="list.php">List All Users</a></h5>
        <div class="col-6">
        <div class="card">
        <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <div class="form-group">
            <!-- <label for="">Name</label> -->
            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" placeholder="Enter Your Name" required>
        </div>
        <div class="form-group">
            <!-- <label for="">Email</label> -->
            <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" placeholder="Enter Your Email" required>
        </div>
        <div class="form-group">
            <!-- <label for="">Phone</label> -->
            <input type="text" class="form-control" name="phone" id="" value="<?php echo $row['phone'];?>" required>
        </div>
        <div class="form-check form-check-inline py-2">
            Gender&nbsp;&nbsp;&nbsp;
            <?php if( $row['gender']=='Male'){
                echo '
             <input type="radio" class="form-check-label" name="gender" value="Male" checked> 
             <label for="" class="form-check-label">Male</label>&nbsp;&nbsp;&nbsp;
             <input type="radio" class="form-check-label" name="gender" value="Female" >Female';
        }else{
            echo '
             <input type="radio" name="gender" value="Male" > 
             <label for="" class="form-check-label">Male</label>&nbsp;&nbsp;&nbsp;
             <input type="radio" name="gender" value="Female" checked> 
             <label for="" class="form-check-label">Female</label>';
            }
            ?>
            
        </div>

        <div class="form-group">
            Work &nbsp;&nbsp;&nbsp;
            <select name="work">
                
                <?php if($row['work']=='Business'){ echo '
                <option value="Business" selected>Business</option>
                <option value="Govt. job">Govt. Job</option>
                <option value="Employee">Employee</option>
                <option value="Workers">Worker</option>
                <option value="Student">Student</option>
                <option value="Other">Other</option>';
                }elseif($row['work']=='Govt. job'){ echo '
                     <option value="Business" >Business</option>
                    <option value="Govt. job" selected>Govt. Job</option>
                    <option value="Employee">Employee</option>
                    <option value="Workers">Worker</option>
                    <option value="Student">Student</option>
                    <option value="Other">Other</option> ';
                }elseif($row['work']=='Employee'){ echo '
                     <option value="Business" >Business</option>
                    <option value="Govt. job" >Govt. Job</option>
                    <option value="Employee" selected>Employee</option>
                    <option value="Workers">Worker</option>
                    <option value="Student">Student</option>
                    <option value="Other">Other</option> ';
                    }elseif($row['work']=='Workers'){ echo '
                     <option value="Business" >Business</option>
                    <option value="Govt. job" >Govt. Job</option>
                    <option value="Employee" >Employee</option>
                    <option value="Workers" selected>Worker</option>
                    <option value="Student">Student</option>
                    <option value="Other">Other</option> ';
                    }elseif($row['work']=='Student'){ echo '
                    <option value="Business" >Business</option>
                    <option value="Govt. job" >Govt. Job</option>
                    <option value="Employee" >Employee</option>
                    <option value="Workers">Worker</option>
                    <option value="Student" selected>Student</option> 
                    <option value="Other">Other</option> ';
                    }else{ echo '
                     <option value="Business" >Business</option>
                    <option value="Govt. job" >Govt. Job</option>
                    <option value="Employee" >Employee</option>
                    <option value="Workers">Worker</option>
                    <option value="Student" >Student</option>
                    <option value="Other" selected>Other</option> ';
                    } 
                    ?>

            </select>
        </div>
        <div>
            <label for="">Description</label><br>
            <textarea name="text" id="" cols="62" rows="4" ><?php echo $row['desciption'];?></textarea>
        </div>
        <div>
            <label for="image">Profile Image</label>
            <input type="file" name="img" required>
        </div>
                
        <input type="submit" class="btn btn-sm btn-success" value="Update">
        </form>
                </div>
                </div>
                </div>
        <?php 
            }
            }else{
                $_SESSION['message']="result not found!";
                header("Location:main.php");exit;
            }
        
    }else{?>
        <title>Add Users</title>
        </head>
        <body>
            <div class="container">
        <h1>Add Users</h1>
        <hr>
        <h5><a class="btn btn-sm btn-primary" href="list.php">List All Users</a></h5>
        
        <div class="col-6">
        <div class="card">
            <div class="card-body">
        <form action="list.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <!-- <label for="">Name</label> -->
            <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required>
        </div>
        <div class="form-group">
            <!-- <label for="">Email</label> -->
            <input type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
        </div>
        <div class="form-group">
            <!-- <label for="">Phone</label> -->
            <input type="text" class="form-control" name="phone" id="" placeholder="Enter Your Phone" required>
        </div>
        <div class="form-check form-check-inline py-1">
            Gender &nbsp;&nbsp;&nbsp;
             <input type="radio" class="form-check-input" name="gender" value="Male">
                <label for="" class="form-check-label">Male</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="gender" value="Female">
                <label for="" class="form-check-label">Female</label>
        </div>
        
        <div class="form-group">
            Work &nbsp;&nbsp;&nbsp;&nbsp;
            <select name="work">
                <option >Choose Options</option>
                <option value="Business">Business</option>
                <option value="Govt. job">Govt. Job</option>
                <option value="Employee">Employee</option>
                <option value="Workers">Worker</option>
                <option value="Student">Student</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label for="">Description</label><br>
            <textarea name="text" id="" cols="62" rows="4" placeholder="Text here"></textarea>
        </div>
        <div>
            <label for="">Profile Image</label>
            <input type="file" name="img" required>
        </div>

        <input type="submit" class="btn btn-sm btn-success" value="Submit">
        </form>
        </div>
    </div>
    </div>
        <?php
    
    }

    ?>
</div>
</body>
<script src="./js/jquery-3.2.1.slim.min.js"></script>
<script src="./js/popper.min.js"></script>

</html>

 <?php
 //update
if(!empty($_SERVER['REQUEST_METHOD']=='POST')){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email= $_POST['email'];
    $gender= $_POST['gender'];
    $phone= $_POST['phone'];
    $work =$_POST['work'];
    $desc= $_POST['text'];
    
     
     
    if(!empty($_FILES['img']['name'])){
        if($_FILES['img']['size']<1048576){
            $allow = array('jpg','png','jpeg','gif');
            $new_profile= $_FILES['img']['name'];
            $ext = pathinfo($new_profile,PATHINFO_EXTENSION);
            if(in_array($ext,$allow)){
              
                $size= $_FILES['img']['size']."<br>";
                $type= $_FILES['img']['type'];
                $temp = $_FILES['img']['tmp_name'];
                $location = "./image/".$new_profile;
                move_uploaded_file($temp,$location);
            }else{
                $_SESSION['message']="File Type Only jpg,jpeg,png,gif Format Allow!";
                header("Location:list.php");exit;
            }
        }else{
            $_SESSION['message']= "File Size 1mb Allow!";
            header("Location:list.php");exit;
        }
    }else{
        $_SESSION['message']= "File Not Found!";
        header("Location:list.php");exit;
    }

    if(!empty($name) && $name !==""){
        $name = htmlentities($name);
    }else{
        $_SESSION['message']="Please Enter Your Name.";
        header("Location:list.php");exit;
    }

    if(!empty($email) && $email !==""){
        $sql = "SELECT * FROM `user` WHERE email='$email'";
        $result = mysqli_query($conn,$sql);
        $have = mysqli_num_rows($result);
        if(!empty($have !==0)){
            $_SESSION['message'] ="Email Already Exits.";
            header("Location:list.php");exit;
        }
    }else{
        $_SESSION['message']="Please Enter Your Email.";
        header("Location:list.php");exit;
        
    }

    if(!empty($gender) ){
        $gender = htmlentities($gender);
    }else{
        $_SESSION['message'] = "Please Select Gender.";
        header("Location:list.php");exit;
    }

    if(!empty($phone) && $phone !==""){
        $phone = htmlentities($phone);
    }else{
        $_SESSION['message'] = "Please Enter Your Phone.";
        header("Location:list.php");exit;
    }

    if(!empty($work)){
        $work = htmlentities($work);
    }elseif($work=='Choose Options'){
        $_SESSION['message'] = "Please Select Your Work.";
        header("Location:list.php");exit;
    }
  
    $desc = htmlentities(htmlspecialchars($desc));
    
    $sql = "UPDATE  `user` SET `name`='$name',`email`='$email',`gender`='$gender',`phone`='$phone',`work`='$work',`desciption`='$desc',`profile`='$new_profile' WHERE `id`='$id'";
    $result =  mysqli_query($conn,$sql);
    
    
    if(!empty($result)){
        $_SESSION['success']="Updated Successful!";
        header("Location:list.php");exit;
    
    }else{
        $_SESSION['message']="Data Not Update.";
        header("Location:list.php");exit;
        
    }
    mysqli_close($conn);
    exit;


}

?> 