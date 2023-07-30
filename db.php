<?php 
	$dbhost = "148.66.138.145";
	$dbuser = "dbCourseSt23a";
	$dbpass = "dbcourseShUsr23!";
	$dbname = "dbCourseSt23";

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if(mysqli_connect_errno()) {
        die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
        );
    }
