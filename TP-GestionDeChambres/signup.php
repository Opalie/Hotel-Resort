<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Gestion Des Chambres</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css-signup/util.css">
	<link rel="stylesheet" type="text/css" href="css-signup/main.css">
<!--===============================================================================================-->
</head>

<body>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="includes/signup.inc.php" method="post">
					<span class="login100-form-title p-b-34">
						Account Sign Up
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20">
						<input id="email" class="input100" type="text" name="FirstName" placeholder="First Name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20">
						<input id="first-name" class="input100" type="text" name="LastName" placeholder="Last Name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20">
						<input class="input100" type="password" name="pwd" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20">
						<input class="input100" type="password" name="pwdrepeat" placeholder="Repat Password">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20">
						<select class="input100" type="select" name="role" placeholder="Choose your Role" required>
                            <option value="1">Employee</option>
                            <option value="2">Receptionist</option>
                            <option value="3">Manager</option>
                        </select>
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit" type="submit" style="margin-bottom: 236px;">
							Sign Up
						</button>
					</div>

                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"]== "emptyinput"){
                                echo"<p>Fill in all fields !</p>";
                            }

                            if($_GET["error"]== "invaliduid"){
                                 echo"<p>Choose a proper Username !</p>";
                            }

                            if($_GET["error"]== "invalidemail"){
                                echo"<p>Choose a proper Email !</p>";
                            }

                            if($_GET["error"]== "passwordsdontmatch"){
                                echo"<p>Password doesn't match !</p>";
                            }

                            if($_GET["error"]== "stmtfailed"){
                                echo"<p>Something went wrong, try again !</p>";
                            }

                            if($_GET["error"]== "usernametaken"){
                                echo"<p>Username Already taken !</p>";
                            }

                             if($_GET["error"]== "none"){
                                echo"<p>You signed up, Congratulations !</p>";
                            }
                        }

                    ?>

					<div class="w-full text-center">
						<a href="login.php" class="txt3">
							Log In
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
			</div>
		</div>
	</div>
</body>
</html>