<?php
    //include database config
    include("config.php");
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Add Siswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>

    <div class="container">
        <a class="btn btn-warning" href="index.php">Go Back</a>
            <br><br>

        <form action="add_bike.php" method="post" name="form1">
            <table>
                <tr>
                    <td>Bike Name:</td>
                    <td><input type="text" name="name" id=""></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="price" id=""></td>
                </tr>
                <tr>
                    <td>Stock:</td>
                    <td><input type="number" name="stock" id=""></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Id_merk:</td>
                    <td><input type="number" name="merk" id=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="Submit" name="Submit" value="AddBike"></td>
                </tr>
            </table>
        </form>
    </div>
        

        <?php
        //Pengecekan jika form submittted diisi pada form diaaats
        if(isset($_POST['Submit'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image = $_POST['image'];
            $id_merk = $_POST['merk'];
           
            
        $result = mysqli_query($mysqli, "INSERT INTO cycle(name,price,stock,image,id_merk) VALUES('$name','$price',$stock,'$image',$id_merk)");

        if ($result) {
            echo "SELAMAT KAMU BERHASIL ANNA";
            }elseif(!$result){
            die("Error in SQL query: " . pg_last_error());
            }else{
                echo "BELUM BERHASIL";
            }
        //Message
        echo "Bike Added Successfully. <a href='index.php'>View Bike</a>";
        }
        ?>
    </body>
</html>