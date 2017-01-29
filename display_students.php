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
    
    <link rel="icon" href="img/logoBig.png">


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



<!--    <div class="row">
        <div class="col-xs-12">
            <table id="yt_table" class="table table-hover table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Topic</th>
                    <th>Availability</th>
                </tr>
            </table>
        </div>
    </div> -->


    </div>

    <?php

        $conn = connect();
        select($conn);
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
            $sql = 'SELECT * FROM student_listing WHERE class_name = "' . $_POST["class_name"] . '";';
            // echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo '<div class="container"><br><p id="intro" class="lead">Below are list of students who need a study buddy in ' . $_POST["class_name"] . '!</p><hr></div>';
                echo '<div class="container"><div class="row"><div class="col-xs-12"><table id="yt_table" class="table table-hover table-striped"><tr><th>Class</th><th>Name</th><th>Email</th><th>Topic</th><th>Availability</th></tr>';

                while($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . $row["class_name"] . '</td><td>' . $row["first_name"] . " " . $row["last_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["topic"] . '</td><td>' . $row["availability"] . '</td></tr>';
                }
                echo '</table></div></div></div>';
            } else {
                echo '<div class="container"><br><p id="intro" class="lead">No students in ' . $_POST["class_name"] . ' is currently looking for a student buddy...</p></div>';
            }
        }

        function insert($conn) {

            // prepare and bind
            $stmt = $conn->prepare("INSERT INTO student_listing (first_name,last_name,email,topic,availability) VALUES (?,?,?,?,?)");
            // i - integer
            // d - double
            // s - string
            // b - BLOB
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $topic, $availability);

            // set parameters and execute
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $topic = $_POST["topic"];
            $availability = $_POST["availability"];
            $stmt->execute();

        }


    ?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="list-inline">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="about.html">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="contactUs.html">Contact Us</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Created by WJL, JY, EA</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
