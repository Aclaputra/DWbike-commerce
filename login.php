<?php
    session_start();
    include ("config.php");

    // $result = mysqli_query($mysqli, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>login to cart</title>
</head>
<body>
    <div class="container">
        

        <div class="card m-auto mt-4 shadow" style="width: 40%;">
            <div class="card-header"><h1 class="text-center">LOGIN PAGE</h1></div>
            <form action="login.php" class="m-4" method="post">
                <?php if(isset($_GET['error'])) { ?>
                <div class="text-danger">
                <p class="error">*<?php echo $_GET['error'];?></p>
                </div>
                <?php } ?>
                
                <div class="mb-3 px-4">
                    <label for="name" class="form-label">Your Email</label>
                    <input type="text" class="form-control" style="width: 90%;" name="email">
                </div>
                <div class="mb-3 px-4">
                    <label for="name" class="form-label">Your Password</label>
                    <input type="password" class="form-control" style="width: 90%;" name="password">
                </div>
                

                <input type="submit" class="btn btn-primary" style="margin: 5px 5px 10px 30px" name="Submit" value="Login"></input>
            </form>
        </div>

        
    </div>

    <?php
    // if (!$_POST['email'] || !$_POST['password'] ) {
    //     die("At least one box was left empty");
    // }

    if(isset($_POST['Submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        

        $result = mysqli_query($mysqli, "SELECT * FROM user WHERE email = '$email' AND password = '$password'") or die("Failed to query database ".mysqli_error());

        $row = mysqli_fetch_array($result);

        if(!isset($row['email']) == $email && !isset($row['password']) == $password){
            
            echo "<div class='container' style='text-align: center'>
                    <div class='card'>
                        <h6>Username or Email not recognized.</h6>
                    </div>
                </div>";
            
            exit;
        } else {
            
                //set session
            $_SESSION['login'] = true;

            // $_SESSION['id'] = $row['id'];
            // header('Location: index.php');
            header('Location: index.php');

            //kita arahkan ke detail.php berdasarkan id
        }

        if(empty($email)) {
            header("Location: login.php?error=User Name is required");
            exit();
        }else if (empty($password)){
            header("Location: login.php?error=Password is required");
            exit();
        }

        
    }

    // if(isset($_POST['email']) && isset($_POST['password'])){

    //     function validate($data){
    //         $data = trim($data);
    //         $data = stripslashes($data);
    //         $data = htmlspecialchars($data);
    //         return $data;
    //     }

    //     $email = validate($_POST['email']);
    //     $password = validate($_POST['password']);

    //     if(empty($email)) {
    //         header("Location: login.php?error=User Name is required");
    //         exit();
    //     }else if (empty($password)){
    //         header("Location: login.php?error=Password is required");
    //         exit();
    //     }else {
    //         $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    //         $result = mysqli_query($mysqli, $sql);

    //         if(mysqli_num_rows($result) === 1) {
    //             $row = mysqli_fetch_assoc($result);
    //             if($row['email'] === $email && $row['password'] === $password){
    //                 $_SESSION['email'] == $row['email'];
    //                 $_SESSION['name'] == $row['name'];
    //                 $_SESSION['id'] == $row['id'];

    //                 header("Location: cart.php");
    //                 exit();
    //             } else {
    //                 header("Location: login.php?error=Incorrect User name or password");
    //                 exit();
    //             }
    //         } else {
    //             header("Location: login.php?error=Incorrect User name or password");
    //             exit();
    //         }
    //     }
    //     $_SESSION['login'] = true;
    //     header("Location: login.php");
    //     exit();
    // }else{
        

        
    // }
    ?>
</body>
</html>