<?php
    include("config.php");
    session_start();
	$status="";

	if(!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
    }
    // print_r($_SESSION);
    
    if (isset($_POST['action']) && $_POST['action']=="remove"){
        if(!empty($_SESSION["cart"])) {
            foreach($_SESSION["cart"] as $key => $value) {
                if($_POST["id"] == $key){
                unset($_SESSION["cart"][$key]);
                $status = "<div class='box' style='color:red;'>
                Product is removed from your cart!</div>";
                }
                // echo "ini isi valuenya";
                // print_r ($value);
                // echo "ini Keynya ".$key;
                if(empty($_SESSION["cart"]))
                unset($_SESSION["cart"]);
                    }		
                }
        }
        
        if (isset($_POST['action']) && $_POST['action']=="change"){
          foreach($_SESSION["cart"] as &$value){
            if($value['id'] === $_POST["id"]){
                $value['quantity'] = $_POST["quantity"];
                break; // Stop the loop after we've found the product
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
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light shadow">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">DW Bike</span>
        <div class="container">
    <a class="btn btn-warning float-end" href="index.php">Back to Home</a>
        </div>
    </div>
</nav>

    <div class="container">

        <h2 class="text-center m-4">SHOPPING CART</h2>   

        <?php
        if(!empty($_SESSION["cart"])) {
        $cart_count = count(array_keys($_SESSION["cart"]));
        ?>
        <div class="cart_div" >
            <!-- <a href="cart.php" style="text-decoration: none;"> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <span><?php echo $cart_count; ?></span>
            <!-- </a> -->
        </div>
        <?php
        }
        ?>

        <div class="cart">
        <?php
        if(isset($_SESSION["cart"])){
            $total_price = 0;
        ?>	
        <table class="table">
        <tbody>
        <tr>
        <td></td>
        <td>ITEM NAME</td>
        <td>QUANTITY</td>
        <td>UNIT PRICE</td>
        <td>ITEMS TOTAL</td>
        </tr>	
        <?php		
        foreach ($_SESSION["cart"] as $product){
        ?>
        <tr>
        <td><img src='img/<?php echo $product["image"]; ?>' width="110" height="80" /></td>
        <td><?php echo $product["name"]; ?><br />
        <form method='post' action=''>
        <input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
        <input type='hidden' name='action' value="remove" />
        <button type='submit' class='remove btn btn-danger'>Remove Item</button>
        </form>
        </td>
        <td>
        <form method='post' action=''>
        <input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
        <input type='hidden' name='action' value="change" />
        <select name='quantity' class='quantity' onchange="this.form.submit()">
        <option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
        <option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
        <option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
        <option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
        <option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
        </select>
        </form>
        </td>
        <td><?php echo "$".$product["price"]; ?></td>
        <td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
        </tr>
        <?php
        $total_price += ($product["price"]*$product["quantity"]);
        }
        ?>
        <tr>
        <td colspan="5" align="right">
        <strong>TOTAL: <?php echo "$".$total_price; ?></strong>
        </td>
        </tr>
        </tbody>
        </table>		
        <?php
        }else{
            echo "<h3>Your cart is empty!</h3>";
            }
        ?>
        </div>

        <div style="clear:both;"></div>

        <div class="message_box" style="margin:10px 0px;">
        <?php echo $status; ?>
        </div>
    </div>
</body>
</html>