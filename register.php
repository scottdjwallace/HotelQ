<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - Register</title>

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

  <section>
    <div class="container">
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <img class="img-login img-responsive" src="img/hotelq_logo_blue_200.png">
          <h2><strong>Join HotelQ</strong>
          </h2>
          <p>Welcome to HotelQ, rent and list unique places to stay from Queen's Alumnae.</p>
          <p><i>All fields required.</i></p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center">
          <form name='register' id='register' action='actions/register_member.php' method='post'>
              <div class="form-group">
                  <input type="text" maxlength="21" required class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                  <input type="password" maxlength="50" required class="form-control" name="password" placeholder="Password">
              </div>

              <div class="form-group">
                  <input type="text" length="10" required class="form-control" name="phone_number" placeholder="Phone Number (Ex. 1234567890)">
              </div>
              <div class="form-group">
                  <input type="text" length="4" required class="form-control" name="grad_year" placeholder="Graduation Year">
              </div>
              <div class="form-group">
                  <input type="text" maxlength="25" required class="form-control" name="address" placeholder="Address">
              </div>
              <div class="form-group">
                  <input type="text" maxlength="25" required class="form-control" name="city" placeholder="City">
              </div>
              <div class="form-group">
                  <input type="text" length="2" required class="form-control" name="state" placeholder="State/Province (Ex. ON)">
              </div>
              <div class="form-group">
                  <input type="text" maxlength="6" required class="form-control" name="area_code" placeholder="Area Code (Ex. H0H0H0)">
              </div>

              <div class="form-group">

                Select an Avatar: &nbsp;
                <select name="avatar">
                  <option value="default">Default</option>
                  <option value="hockey">Hockey</option>
                  <option value="car">Car</option>
                  <option value="city">City</option>
                  <option value="pizza">Pizza</option>
                </select>

                &nbsp; &nbsp; &nbsp; &nbsp; Degree: &nbsp;
                <select name="degree">
                  <option value="bsc">BSc</option>
                  <option value="bfa">BFA</option>
                  <option value="beng">BEng</option>
                  <option value="bphe">BPHE</option>
                  <option value="ba">BA</option>
                  <option value="bcmp">BCmp</option>
                  <option value="bcomm">BComm</option>
                  <option value="bscn">BScN</option>
                  <option value="bed">BEd</option>
                  <option value="msc">MSc</option>
                  <option value="meng">MEng</option>
                  <option value="phd">PhD</option>
                  <option value="bkin">BKin</option>
                  <option value="bmus">BMus</option>
                  <option value="mba">MBA</option>
                  <option value="ma">MA</option>
                  <option value="masc">MASc</option>
                  <option value="med">MEd</option>
                  <option value="llm">LLM</option>
                </select>
              </div>

              <div class="form-group">
                Faculty: &nbsp;
                <select name="faculty">
                  <option value="artssci">Arts & Science</option>
                  <option value="eng">Engineering</option>
                  <option value="phe">Physical Health Education</option>
                  <option value="comp">Computing</option>
                  <option value="bus">Business</option>
                  <option value="nurs">Nursing</option>
                  <option value="edu">Education</option>
                  <option value="kin">Kinesiology</option>
                  <option value="heal">Health Sciences</option>
                  <option value="pol">Policy Studies</option>
                </select>
              </div>

              <div class="form-group">
                <input class="btn btn-default btn-lg" type='submit' id='registerBtn' name='registerBtn' value='Register' />
              </div>

          </form>


        </div>
      </div>

  </section>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
