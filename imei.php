<?php
session_start();
require_once "db/config.php";

if (!isset($_SESSION["email"])) {
    header("location: login.php");
    exit;
}


// Get the logged in user's email from session
$email = $_SESSION["email"]; // Make sure this is set when the user logs in

$imei = $phone_type = $ob_number = "";
$imei_err = $ob_number_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imei = trim($_POST["imei"]);
    $phone_type = trim($_POST["phone_type"]);
    $ob_number = trim($_POST["ob_number"]);

    // Check if IMEI already exists
    $check_sql = "SELECT id FROM imei WHERE imei = ? OR ob_number = ?";
    if ($stmt_check = mysqli_prepare($connection, $check_sql)) {
        mysqli_stmt_bind_param($stmt_check, "ss", $imei, $ob_number);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            echo "<script>alert('IMEI or OB Number already registered.');</script>";
        } else {
            $insert_sql = "INSERT INTO imei (imei, email, phone_type, ob_number) VALUES (?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($connection, $insert_sql)) {
                mysqli_stmt_bind_param($stmt, "ssss", $imei, $email, $phone_type, $ob_number);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('IMEI reported successfully.');</script>";
                } else {
                    echo "<script>alert('Something went wrong. Try again later.');</script>";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_stmt_close($stmt_check);
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Register</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
    /* Style the submit button with a specific background color etc */

    .login-box{
width: 300px;
position: relative;
/* top:0%; */
left: 50%;
transform: translate(-50%,2%);
color: black;
/* display: ; */

}
.textbox{
	width: 100%;
	overflow: hidden;
	font-size: 20px;
	padding:8px 0;
	margin: 8px 0;
	border-bottom:1px solid; 
}

.textbox i{
	width: 26px;
	float: left;text-align: center;
}

.textbox input{
	border: none;
	outline: none;
	background: none;
}
.btn{
	width: 100%;
	background: none;
	border: 2px solid black;
	color: red;  
	padding: 5px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px;
}
.login-box #hl{

	float: left;
	font-size: 40px;
	border-bottom: 6px solid #4caf50;
	margin-bottom: 1px;
	padding: 13px 0;

}
input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    /* When moving the mouse over the submit button, add a darker green color */
    input[type=submit]:hover {
    background-color: #45a049;
    }
    /* Style the submit button with a specific background color etc */
    input[type=reset] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    /* When moving the mouse over the submit button, add a darker green color */
    input[type=reset]:hover {
    background-color: #45a049;
    }
    /* Add a background color and some padding around the form */
    .contaner {
    border-radius: 5px;
    background-color: #f2f2f2;
    /* padding: 20px; */
    height:550px;
    width:550px;
    position: absolute;
    top:0.5px;
    left: 50%;
    transform: translate(-50%,5%);
    color: white;
    
    }/* CSS Document */
    
    </style>
</head>
<body>
<div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.html">
                        <img src="images/logo.png" alt="" />
                        <span>
              Mbau Finders
            </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="about.html"> About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="work.html">Work </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.html"> Category </a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <a href="login.php">
                                <span>
                  Login
                </span>
                            </a>
                            <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="custom_menu-btn ">
                            <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
                        </div>
                    </div>

                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>
    <div class="contaner">
   
        
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="login-box">
        <h1 id="hl">Report IMEI</h1>

        <div class="textbox">
            <input type="text" name="imei" class="form-control" placeholder="15-digit IMEI Code" required>
        </div>
        <br>

        <div class="textbox">
            <input type="text" name="phone_type" class="form-control" placeholder="Phone Type" required>
        </div>
        <br>

        <div class="textbox">
            <input type="text" name="ob_number" class="form-control" placeholder="OB Number" required>
        </div>
        <br>

        <div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </div>
</form>

    </div>
   

<footer class="container-fluid footer_section ">
        <div class="container">
            <p>
                &copy; <span id="displayDate"></span> All Rights Reserved By
                <a href="#">Mbau Finders</a>
            </p>
        </div>
    </footer>
    <!-- end  footer section -->


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>