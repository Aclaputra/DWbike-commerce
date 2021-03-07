<?php 
    session_start();
    include("config.php");

    $status="";
    if (isset($_POST['id']) && $_POST['id']!=""){
    $id = $_POST['id'];
    $result_id = mysqli_query($mysqli,"SELECT * FROM cycle WHERE id = $id");
    $row = mysqli_fetch_assoc($result_id);
    $name = $row['name'];
    $id = $row['id'];
    $price = $row['price'];
    $stock = $row['stock'];
    $image = $row['image'];

    $cartArray = array(
        $id=>array(
        'name'=>$name,
        'id'=>$id,
        'price'=>$price,
        'stock'=>$stock,
        'quantity'=>1,
        'image'=>$image)
    );

    if(empty($_SESSION["cart"])) {
        $_SESSION["cart"] = $cartArray;
        $status = "<div class='box text-info text-center'>Product is added to your cart!</div>";
    }else{
        $array_keys = array_keys($_SESSION["cart"]);
        if(in_array($id,$array_keys)) {
            $status = "<div class='box text-center' style='color:red;'>
            Product is already added to your cart!</div>";
        } else {
            $_SESSION["cart"] = array_merge($_SESSION["cart"],$cartArray);
            $status = "<div class='box text-info text-center'>Product is added to your cart!</div>";
        }
    }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body style="background-color: black;">
    <!-- navbar -->
    
    <nav class="navbar navbar-dark" style="background-color: black;">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">DW Bike</span>
        <div class="container">
        <?php
        if(!empty($_SESSION["cart"])) {
        $cart_count = count(array_keys($_SESSION["cart"]));
        ?>
        <a href="cart.php" class="btn float-end btn-danger">My Order <span><?php echo $cart_count; ?></span></a>

        <?php } ?>
        </div>
    </div>
    </nav>
    

    <!-- content -->
    <div class="container d-flex justify-content-evenly flex-wrap ">

        <!-- <div class='col-md-4'>
            <div class='card m-5 bg-dark'>
                <form method='post' action='' class='text-center'>
                    <input type='hidden' name='id' value= />
                    <div class='img overflow-hidden' ><img src='img/surly.jpg' style='width: 100%;'/></div>
                    <div class='name'>test</div>
                    <div class='merk'>HALO</div>
                    <div class='price'>HALO</div>
                    <div class='stock'>HALO</div>
                    <button type='submit' class='buy btn btn-danger m-3' style='width: 90%; '>Buy Now</button>
                </form>
            </div>
        </div> -->
        
        <?php 
            $result = mysqli_query($mysqli, "SELECT * FROM cycle INNER JOIN merk ON cycle.id_merk = merk.Id");

            while($bike_data = mysqli_fetch_assoc($result)){
                echo "<div class='col-md-4' style='width: 33%;'>";
                echo "<div class='card m-5 bg-dark' >"; //product wrapper
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='id' value=".$bike_data['id']." />";

                echo "<div class='img overflow-hidden' style='height: 12rem;'>";
                echo "<img src='./img/".$bike_data['image']."' class='card-img-top p-1' alt='...'>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<div class='d-flex justify-content-between'>";
                echo "<h5 class='card-title text-white'>".$bike_data['name']."</h5>";
                echo "<p class='card-text text-muted'>".$bike_data['Name']."</p>";
                echo "</div>";
                echo "<div class='d-flex justify-content-between'>";
                echo "<p class='card-text text-danger'>$ ".$bike_data['price']."</p>";
                echo "<p class='card-text text-muted'>Stock: ".$bike_data['stock']."</p>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-danger btn-block buy' style='width: 100%'>Buy</button>";
                echo "</div>";
                echo "</form>";

                echo "</div>"; //product wrapper
                echo "</div>";
            }
        // mysqli_close($mysqli);
        ?>

    </div>
    
    <br><br>
    <div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
    </div>

    <!-- navbar bottom/footer -->
    <footer class="mastfoot mt-auto fixed-bottom">
     <div class="inner m-4">
         <div class="small text-center text-dark">Copyright © 2021 - DumbWays Bike</div>
     </div>
    </footer>
</body>
</html>