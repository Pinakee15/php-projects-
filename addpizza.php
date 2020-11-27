<?php 
    $email = $ingredients = $title = "" ; 
    $errors = array('email'=>'','title'=>'','ingredients'=>'');

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        if(empty(trim($email))){
            $errors['email'] = "the email field is required";
        }
        else{
            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                $errors['email'] =  "Valid email Id must be entered ";
            }
        }
        if(empty(trim($_POST['title']))){
            $errors['title'] =  "the title field is required..";
        }
        else{
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] =  "Title should contain only letter and spaces";
            }
        }
        if(empty(trim($_POST['ingredients']))){
            $errors['ingredients'] =  "the ingredients field is required..";
        }
        else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = "values should be comma separated";
            }
        }

        // Check whether the form is not empty and redirect it to the home page
        if(array_filter($errors)){
            echo "there are errors";
        }
        else{
            header('Location: index.php');
        }

        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['title']) ;
        // echo htmlspecialchars($_POST['ingredients']);
        // echo htmlspecialchars($_POST['submit']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.php "); ?>
    <section class = "container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="addpizza.php" method = "POST">
            <label>Your email:</label>
            <input type="text" name="email" value = <?php echo htmlspecialchars($email); ?>>
            <div class = "red-text"> <?php echo $errors['email']; ?> </div>
            <label>Pizza Title:</label>
            <input type="text" name="title" value = <?php echo htmlspecialchars($title); ?>>
            <div class = "red-text"> <?php echo $errors['title'] ;?> </div>
            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value = <?php echo htmlspecialchars($ingredients); ?>>
            <div class = "red-text"> <?php echo $errors['ingredients']; ?> </div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include("templates/footer.php") ?>