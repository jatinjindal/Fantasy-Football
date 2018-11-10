<?php include 'components/authentication.php' ?>
<?php include 'components/session-check.php' ?>
<?php include 'controllers/base/head.php' ?>
<?php include 'controllers/navigation/first-navigation.php' ?>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<div class="row clearfix">
<h1> Leaderboard </h1>


<?php
    include '_database/database.php';
    session_start();
    $current_user = $_SESSION['user_username'];
    // $sql = "SELECT * FROM user WHERE user_username != '$current_user' order by user_id desc";

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

    $sql = "SELECT * FROM user";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

    while($rws = mysqli_fetch_array($result)){
        $temp = "python ./script.py ".$rws['forw']." ".$rws['def']." ".$rws['gkp']." ".$rws['mid'];
        $output = shell_exec($temp);

        if ($isnewmatch == 0) {
            $a = 1;
        }
        else {
            // if ($rws['user_username'] == $current_user) echo "<h2> Updates: </h2>";

            $temp = "python ./new_scores.py ".$rws['forw']." ".$rws['def']." ".$rws['gkp']." ".$rws['mid'];
            $output = shell_exec($temp);
            $new_info = explode("<br>",$output);
            $new_score = 0;
            foreach ($new_info as $player) {
                parse_str($player);
                $new_score = $new_score + $points;
            }
            // if ($rws['user_username'] == $current_user) echo "<h2> You gained: ".$new_score." points </h2>";
            if ($rws['score'] != NULL) $new_score = $new_score + $rws['score'];

            $curr = $rws['user_username'];
            $sql = "UPDATE user SET score=".$new_score." WHERE user_username = '".$curr."'";
            // echo $sql;
            $result1 = mysqli_query($database,$sql) or die(mysqli_error($database));
            // if ($rws['user_username'] == $current_user) echo "<h2> Your new score: ".$new_score." points </h2>";
        }
    }

    $sql = "SELECT * from user ORDER BY score DESC";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

?>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Position</th>
      <th scope="col">Username</th>
      <th scope="col">Score</th>
    </tr>
  </thead>


<?php
        $ranking = 1;
        while($rws = mysqli_fetch_array($result)){
?>

        <tr>
             <td><?php echo $ranking; ?></td>
             <td><?php echo $ranking; ?></td>
             <td><?php echo $rws['user_username']; ?></td>
             <td><?php
                if ($rws['score'] != NULL) echo $rws['score'];
                else echo '-';
            ?></td>
           <?php
             $ranking = $ranking + 1; /* INCREMENT RANKING BY 1 */
           ?>
        </tr>
<!--         $user = $rws['user_username'];
        echo "<h4>$i. $user</h4>";
        $i = $i + 1;
 -->
<?php
    }


?>

</table>

</div>
</div>
</div>
</div>
