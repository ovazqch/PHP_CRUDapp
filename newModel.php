<?php
session_start();
include 'includes/connectionSet.php';
include 'includes/header.php';

if(isset($_SESSION['admin'])){
    $role = $_SESSION['admin'];
}

if($role == 0){
    header('location: modelDisplay.php');
}

    $nameError = "";
    $descError = "";
    $priceError = "";
    $availError = "";

if(isset($_POST['update'])){

    $mName = $_POST['modelName'];
    if(empty($mName)){
        $nameError = "<p style='color:red; font-size: 11px;'><strong>Please enter a valid name</strong> </p>";
    }
    $mDescription = $_POST['modelDescription'];
    if(empty($mDescription)){
        $descError = "<p style='color:red; font-size: 11px;'><strong>Please enter a valid description</strong> </p>";
    }
    $mPrice = $_POST['modelPrice'];
    if(empty($mPrice) || $mPrice < 0){
        $priceError = "<p style='color:red; font-size: 11px;'><strong>Please enter a valid price</strong> </p>";
    }
    $mAvailability = $_POST['modelAvailability'];
    if(empty($mAvailability) || $mPrice < 0){
        $availError = "<p style='color:red; font-size: 11px;'><strong>Please enter a valid availability</strong> </p>";
    }
    if(empty($mName) || empty($mDescription) || empty($mPrice) || $mPrice < 0 || empty($mAvailability) || $mAvailability < 0){
        echo "<p style='color:red'><strong>The information in the form is not valid. Please fill correct details</strong> </p>";
    } else {
        try{
            if(empty($_FILES)){
                throw new Exception('Invalid Upload');
            }
    
            switch ($_FILES['modelImage']['error']){
                case UPLOAD_ERR_OK:
                    break;
    
                case UPLOAD_ERR_INI_SIZE:
                    throw new Exception('File is too large, please upload smaller image');
                    break;
    
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file to upload');
                    break;
                default:
                    throw new Exception('There is an error');
                    break;
            }
    
            $filesize = 2000000;
            if($_FILES['modelImage']['size'] > $filesize){
                throw new Exception('File is too large');
            }
    
            $file_types = ['image/gif', 'image/png', 'image/jpeg'];
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($fileinfo, $_FILES['modelImage']['tmp_name']);
    
            if(!in_array($mime_type, $file_types)){
                throw new Exception('Invalid file type, please upload images');
            }
    
            $pathinfo = pathinfo($_FILES['modelImage']['name']);
            $base = $pathinfo['filename'];
            $base = mb_substr($base, 0, 200);
            $filename = $base.".".$pathinfo['extension'];
            $destination = "images/$filename";
    
            if(file_exists($destination)){
                echo "File Already Exist in the folder";
            } else {
                if(move_uploaded_file($_FILES['modelImage']['tmp_name'], $destination)){
                    //echo "File Uploaded successfully";
                }else{
                    throw new Exception('Unable to move the uploaded file');
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    
        $mImage_name = $_FILES['modelImage']['name'];
        $mImage = $_FILES['modelImage']['tmp_name'];
        $location = "images/" . $mImage_name;
    
        $sql = "INSERT INTO products(product_name, product_description, product_price, product_availability, product_image) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if($stmt === false){
            echo $conn->error();
        } else {
            $stmt->bind_param("ssdis", $mName, $mDescription, $mPrice, $mAvailability, $mImage_name);
            if(mysqli_stmt_execute($stmt)){
                move_uploaded_file($mImage_name, $location);
                $id = mysqli_insert_id($conn);
                echo "<p style='color:green'><strong>Model successfully added ID:" .$id. "</strong></p>";
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}
?>

<div class="container">
    <h1>New model</h1>
        <div class="row">
            <form action=<?=$_SERVER['PHP_SELF']?> method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="modelName" class="form-control" placeholder="">*<?php echo $nameError; ?></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="modelDescription" rows="4" cols ="50"></textarea>*<?php echo $descError; ?></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="text" name="modelPrice" class="form-control" placeholder="">*<?php echo $priceError; ?></td>
                    </tr>
                    <tr>
                        <td>Avaliability:</td>
                        <td><input type="text" name="modelAvailability" class="form-control" placeholder="">*<?php echo $availError; ?></td>
                    </tr>
                    <tr>
                        <td>Image:</td>
                        <td><input type="file" name="modelImage" class="btn btn-primary" placeholder=""></td>
                    </tr>
                </table>
                <div><br>
                    <input type="submit" class="btn btn-success" value="Create model" name="update">
                </div>
            </form>
        </div>
    <div class="backDashboard">
            <a href="adminDashboard.php">Back to Dashboard</a>
    </div>
</div>


<?php
include 'includes/footer.php';