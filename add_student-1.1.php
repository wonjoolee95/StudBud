<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>StudBud | Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    	#submitConformation {

			width: 600px;
			height: 300px;

			text-align: center;

			position: absolute;
			top:0;
			bottom: 0;
			left: 0;
			right: 0;

			margin: auto;
    	}

    </style>

</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="index.html">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="findClasses.html">Find Classes</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="contactUs.html">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<?php 

		$conn = connect();
		insert($conn);
		close($conn);

		function connect() {
			// Credentials
			$servername = "localhost";
			$username = "studbudx_root";
			$password = ;
			$dbname = "studbudx_studbud";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			return $conn;
		}

		function close($conn) {
			$conn->close();
		}

		function select($conn) {
			$sql = "SELECT * FROM student_listing";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    echo '<div class="container"><div class="row"><div class="col-xs-12"><table id="yt_table" class="table table-hover table-striped"><tr><th>Class</th><th>Name</th><th>Email</th><th>Topic</th><th>Availability</th></tr>';

			    while($row = $result->fetch_assoc()) {
			        echo '<tr><td>' . $row["class_name"] . '</td><td>' . $row["first_name"] . " " . $row["last_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["topic"] . '</td><td>' . $row["availability"] . '</td></tr>';
			    }
			    echo '</table></div></div></div>';
			} else {
			    echo "0 results";
			}
		}

		function insert($conn) {

			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO student_listing (class_name,first_name,last_name,email,topic,availability) VALUES (?,?,?,?,?,?)");
			// i - integer
			// d - double
			// s - string
			// b - BLOB
			$stmt->bind_param("ssssss", $class_name, $first_name, $last_name, $email, $topic, $availability);

			// set parameters and execute
			$class_name = $_POST["class_name"];
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
			$email = $_POST["email"];
			$topic = $_POST["topic"];
			$availability = $_POST["availability"];
			$stmt->execute();
			
			echo '<div id="submitConformation" class="h1"><h2>You successfully listed yourself in ' . $class_name . '!<h2><p class="lead">You are one step closer to finidng your perfect study buddy!</p><p><a href="findClasses.html">Click here</a> to return to class listings.</div>';

	        

		}

	?>

</body>
</html>
