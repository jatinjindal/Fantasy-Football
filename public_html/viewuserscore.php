<?php include 'components/authentication.php' ?>
<?php include 'components/session-check.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<div class="row clearfix">


<?php
include '_database/database.php';
session_start();
$current_user = $_SESSION['user_username'];

$sql = "SELECT * FROM user WHERE user_username = '$current_user'";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));
while($rws = mysqli_fetch_array($result)){
    echo "<h1> Your Team </h1>" ;

    $temp = "python ./script.py ".$rws['forw']." ".$rws['def']." ".$rws['gkp']." ".$rws['mid'];
    // echo $temp;
    $output = shell_exec($temp);
    echo $output;

    $temp = "python3 ./newmatches.py";
    $output = shell_exec($temp);

    if ($output == "") {
        echo "<h2> No new matches held. Come back after the next matchday </h2>";
    }
    else {
        echo "<h2>Something happened. Your team has got even more pts!</h2>";
        // echo $output;
        $team_home = "Manchester United";
        $team_away = "Manchester City";

        $temp = "python ./new_scores.py ".$rws['forw']." ".$rws['def']." ".$rws['gkp']." ".$rws['mid']." ".$team_home." ".$team_away;
        // echo $temp;
        $output = shell_exec($temp);
        echo $output;
    }
}
?>
</div>
</div>
</div>
</div>
