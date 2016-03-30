<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Catamaran:600' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <?php
   //Create a user session or resume an existing one\
   session_start();
  ?>

  <?php
    //check if the user clicked the logout link and set the logout GET parameter
    if(isset($_GET['logout'])){
 	    //Destroy the user's session.
 	    $_SESSION['member_id']=null;
 	    session_destroy();
    }
  ?>
  <?php
    //check if the user is already logged in and has an active session
    if(isset($_SESSION['member_id'])){
      //Redirect the browser to the profile editing page and kill this page.
      header("Location: home.php");
      die();
    }
  ?>

  <?php
    //check if the login form has been submitted
    if(isset($_POST['loginBtn'])){
      // include database connection
      include_once './actions/conn.php';
      // SELECT query
      $query = "SELECT member_id FROM member WHERE email=? AND password=?";
      // prepare query for execution
      if($stmt = $con->prepare($query)){
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("ss", $_POST['email'], $_POST['password']);
        // Execute the query
        $stmt->execute();

        /* resultset */
        $result = $stmt->get_result();

        // Get the number of rows returned
        $num = $result->num_rows;;

        if($num>0){
          //If the username/password matches a user in our database
          //Read the user details
          $myrow = $result->fetch_assoc();
          //Create a session variable that holds the user's id
          $_SESSION['member_id'] = $myrow['member_id'];
          //Redirect the browser to the profile editing page and kill this page.
          header("Location: home.php");
          die();
         } else {
          //If the username/password doesn't matche a user in our database
          // Display an error message and the login form
          echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Login Failed!</strong> Please login with the correct credentials.</div>";
         }
     }
   }
  ?>



  <!-- Navigation -->
  <div class="navbar navbar-default navbar-fixed-top nav-login">
    <div class="container">
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <form class="navbar-form navbar-right" name='login' id='login' action='index.php' method='post'>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <input class="btn btn-default" type='submit' id='loginBtn' name='loginBtn' value='Sign In' />
                    </div>
                </form>
            </div>
        </center>
    </div>
</div>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <img class="img-login img-responsive" src="img/hotelq_logo_200.png">
            <h1>HotelQ</h1>
            <h3>Rent unique places to stay from Queen's Alumnae.</h3>
            <br>
            <a href="register.php" class="btn btn-light btn-lg">Sign Up</a>
        </div>
    </header>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>
