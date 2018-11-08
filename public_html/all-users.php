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
    // $sql = "SELECT * FROM user WHERE user_username != '$current_user' order by user_id desc";

    $sql = "SELECT * from user ORDER BY money ASC";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));
    $i = 1;
    while($rws = mysqli_fetch_array($result)){
        $user = $rws['user_username'];
        echo "<h4>$i. $user</h4>";
        $i = $i + 1;
    }
?>
</div>
</div>
</div>
</div>
