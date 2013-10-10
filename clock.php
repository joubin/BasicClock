<html>
<?php
$user = $_POST['user'];
$password = $_POST['password'];
$user = stripslashes($user);
$password = stripslashes($password);
// echo password_hash($password, PASSWORD_DEFAULT)."\n";

$user = stripslashes($user);
$password = stripslashes($password);

// CONNECT TO THE DATABASE
    $DB_NAME = 'hours';
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = 'root';
    
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT * FROM `users` WHERE username='$user' and password='$password'";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];

        $query2 = "SELECT * FROM times where userID='$userID' order by id DESC LIMIT 1";
        $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
        $lastRow = $result2->fetch_assoc();
        $x = $result2->num_rows ;
        $lasrRowID = $lastRow['id'];
        if( $x == 0 || $lastRow['hasClockOut'] == 1){
                $query2 = "INSERT INTO times (`timein`, `hasClockOut`, `userID` ) values(NOW(), 0, '$userID') ";
                $result = $mysqli->query($query2) or die($mysqli->error.__LINE__);
                echo "<script>alert('You have clocked in')</script>";
                echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='index.html'</SCRIPT>");
                //header( 'Location: index.html' ) ;

                
        }else{
            // echo $userID;
            $query = "UPDATE times set `timeout`=NOW(), `hasClockOut`=1 where `id`='$lasrRowID';";
            $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
            $query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(sum))) as something FROM (select timein, timeout, (timeout-timein) as sum from times WHERE `USERID`=$userID) as a;";

            $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
            $r = $result->fetch_assoc();
            echo '<script>alert("You have clocked out Total Time: ';
            echo $r["something"];
            echo '")</script>';
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='index.html'</SCRIPT>");

    
        // header( 'Location: index.html' ) ;

        }

    }
    else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>alert('hmmm, I dont seem to find your login info. :\( \\nCare to try again?')</SCRIPT>");

            echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='index.html'</SCRIPT>");
    }

    


?>
</html>