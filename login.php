<?php
    session_start();
?>
<?php
    $usernameErr = $passwordErr = "";
    require 'connection.php';
    if(isset($_POST['username'])) {
        $custPhone=$_POST['username'];
        $custPasswd=md5($_POST['password']);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        if (empty($username)) {
            $usernameErr = '* Username is required';
        }
        if (empty($password)) {
            $passwordErr = '* Password is required';
        }
        $sql="select * from accounts where accPhone='".$custPhone."'AND accPasswd='".$custPasswd."' limit 1";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) == 1 ) {
            $row = $result->fetch_assoc();
            $_SESSION['user_login'] = $row['accPhone'];
            $_SESSION['user_id'] = $row['accID'];
            $_SESSION['user_type'] = $row['accType'];
            /*if($row['accType'] == 2) {
                header("Location: ./main.php");
                exit();
            }
            else if($row['accType'] == 1) {
                echo "you are employee";
                exit();
            }*/
            header("Location: ./main.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style-login.css">
</head>
<body>
    <a href="./main.php"><input type="button" value="Home" class="btn-login home"/></a>
	<div class="container-login">
    <h1>Rent Car KD</h1>
	<!-- <img src="image/login.png"/> -->
		<form method="POST" action="#">
			<div class="form-input">
				<table>
                    <tr>
                        <td><input type="text" name="username" placeholder="Enter the User Name"/></td>
                        <td><span class="error"><?php echo $usernameErr; ?></span></td>
                    </tr>
                <table>
			</div>
			<div class="form-input">
                <table>
                    <tr>
                        <td><input type="password" name="password" placeholder="Password"/></td>
                        <td><span class="error"><?php echo $passwordErr; ?></span></td>
                    </tr>
                </table>
			</div>
            <span id="error"></span>
            <div class="form">
                <input type="submit"  value="LOGIN" class="btn-login"/>
			</div>
		</form>
        <div>
            <br>
            <a href="./register.php"><input type="submit" value = "REGISTER?" class="btn-login"/></a>
        </div>
	</div>
</body>
</html>