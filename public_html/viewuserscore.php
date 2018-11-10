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

$sql = "SELECT * FROM matches";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));
$python_arg = '';
while($rws = mysqli_fetch_array($result)) $python_arg .= $rws['id'].",";
// echo $python_arg;
// echo '<br>';

$temp = "python3 ./newmatches.py ".$python_arg;
$output = shell_exec($temp);
$new_ids = explode("\n",$output);
$isnewmatch = 0;
foreach ($new_ids as $id) {
    if ($id == NULL) continue;
    $isnewmatch = 1;
    $sql = "INSERT into matches VALUES($id)";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));
}

// // $bash_command = "echo ".$output.">> recorded_matches.txt";
// // $output22 = shell_exec($temp);
//
// $file = 'recorded_matches.txt';
// // Open the file to get existing content
// $current = file_get_contents($file);
// // Append a new person to the file
// $current .= $output;
// // Write the contents back to the file
// echo $current;
// file_put_contents($file, $current)  or die('write failed');
// fclose($file);

// $new_matches = 1;
// if ($output == "") $new_matches = 0;
//
$sql = "SELECT * FROM user";
$result = mysqli_query($database,$sql) or die(mysqli_error($database));

while($rws = mysqli_fetch_array($result)){
    // echo $rws['user_username'];
    if ($rws['user_username'] == $current_user) echo "<h1> Your Team </h1>" ;

    $temp = "python ./script.py ".$rws['forw']." ".$rws['def']." ".$rws['gkp']." ".$rws['mid'];
    $output = shell_exec($temp);
    if ($rws['user_username'] == $current_user) {
        echo $output;
        echo "<h2> Your Old Score: ".$rws['score']."</h2>";
    }

    if ($isnewmatch == 0) {
        if ($rws['user_username'] == $current_user) echo "<h2> No new matches held. Come back after the next matchday </h2>";
    }
    else {
        if ($rws['user_username'] == $current_user) echo "<h2> Updates: </h2>";

        $temp = "python ./new_scores.py ".$rws['forw']." ".$rws['def']." ".$rws['gkp']." ".$rws['mid'];
        $output = shell_exec($temp);
        $new_info = explode("<br>",$output);
        $new_score = 0;
        foreach ($new_info as $player) {
            parse_str($player);
            $new_score = $new_score + $points;
        }
        if ($rws['user_username'] == $current_user) echo "<h2> You gained: ".$new_score." points </h2>";
        if ($rws['score'] != NULL) $new_score = $new_score + $rws['score'];

        $curr = $rws['user_username'];
        $sql = "UPDATE user SET score=".$new_score." WHERE user_username = '".$curr."'";
        // echo $sql;
        $result1 = mysqli_query($database,$sql) or die(mysqli_error($database));
        if ($rws['user_username'] == $current_user) echo "<h2> Your new score: ".$new_score." points </h2>";
    }
}
?>
</div>
</div>
</div>
</div>
