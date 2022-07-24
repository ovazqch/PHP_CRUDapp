<?php session_start();
    include 'includes/connectionSet.php';
    include 'includes/header.php';

    if(isset($_GET['sesion_close'])){
        session_unset(); 
        session_destroy(); 
    }
?>
    <div class="center-screen">
        <div class="loginPage">
            <div class="formContainer">
                <div>
                    <div>
                        <h2>Login</h2>
                    </div>
                    <div>
                        <form action=<?=$_SERVER['PHP_SELF']?> method="post">
                            <label>Email: </label><br>
                            <input type="text" name="email"><br>
                            <label>Password: </label><br>
                            <input type="password" name="password"><br><br>
                            <input type="submit" Name="submit" value="Login">
                        </form>
                    </div>
                    <div>
                        <br>
                    </div>
                    <div>
                        <h3>Credentials:</h3>
                        <p>Admin: email=admin@bmw.com / password:1q2w3e4r</p>
                        <p>User: email=user@user.com / password:usertest1</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    

    <?php
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = md5($_POST['password']);
    
        $sql = "SELECT * from users WHERE email=? and password=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo $conn->mysqli_error();
        } else {
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        }

        if (empty($user)) { 
            echo "<p style='color:red'> <strong>Please input valid credentials</strong></p>";

        } else {
            $_SESSION['name'] = $user['email'];
            $is_Admin = $user['is_admin'];
            $_SESSION['admin'] = $is_Admin;
            if($is_Admin == 1){
                header('location: adminDashboard.php');
            } else {
                header('location: modelDisplay.php');
            }
        }
    }
    
    include 'includes/footer.php';
