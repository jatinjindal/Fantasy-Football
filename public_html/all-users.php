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
// $command = escapeshellcmd('./script.py');
$output = shell_exec("python ./script.py");
echo $output;
echo "hello";
?>
<?php
    include '_database/database.php';
    session_start();
    $current_user = $_SESSION['user_username'];
    // $sql = "SELECT * FROM user WHERE user_username != '$current_user' order by user_id desc";

    $sql = "SELECT * from user ORDER BY money ASC";
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
             <td><?php echo $rws['money']; ?></td>
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


