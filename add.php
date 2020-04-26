<?php
include('config/db_connect.php');
$email=$ingredients=$title="";
    $errors = array('email'=>'','title'=>'','ingredients'=>'');
    if( isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $errors['email']='An email is required <br />';
        } else{
        $email= $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email']='email must be a valid email address';
        }
        }
        //TITLE
        if(empty($_POST['title'])){
            $errors['title']='An title is required <br />';
        }else{
            $title=$_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
             $errors['title']= 'title must be letters only';
            }
        }
        
        if(empty($_POST['ingredients'])){
            $errors['ingredients']=  'Atleast 1 ingredient is required <br />';
        }else{
            $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
            $errors['ingredients']= 'ingredients must comma seperated and letters only';
         }
        }
        if(array_filter($errors)){
           // echo "errors in the form"
        }else{
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);

            // create sql
            $sql="INSERT INTO pizzas(title,email,ingredients)VALUES('$title','$email','$ingredients')";
        

            //save and check
            if(mysqli_query($conn,$sql)){
                //success
                header('location: index.php');
            }else{
                //error
                echo 'query error'.mysqli_error($conn);
            }


        }
    }

?>


<!DOCTYPE html>
<html>
<?php include('template/header.php');?>
<section class="container grey-text">
<h4 class="center">Add a Pizza</h4>
<form class="white" action="add.php" method="POST">
    <label>Your Email:</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
    <div class="red-text"><?php echo $errors['email'];?></div>
    <label>Pizza Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
    <div class="red-text"><?php echo $errors['title'];?></div>
    <label>Ingredient (comma seperated):</label>
    <input type="text" name="ingredients"value="<?php echo htmlspecialchars($ingredients) ?>">
    <div class="red-text"><?php echo $errors['ingredients'];?></div>
    <div class="center">
    <input type="submit"name="submit" value="submit" class="btn brand z-depth-0">
    </div>
</form>
</section>
<?php ?>
<?php include('template/footer.php');?>



</body>
</html>