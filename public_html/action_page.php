<?php
    session_start();
?>

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
    // UPDATE table_name
    // SET column1=value, column2=value2,...
    // WHERE some_column=some_value

    $money_left = $_POST["money"];
    $def = $_POST["def"];
    $mid = $_POST["mid"];
    $forw = $_POST["for"];
    $gkp = $_POST["gkp"];

    $sql = "UPDATE user SET money='$money_left' WHERE user_username = '$current_user'";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

    $sql = "UPDATE user SET def='$def' WHERE user_username = '$current_user'";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

    $sql = "UPDATE user SET mid='$mid' WHERE user_username = '$current_user'";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

    $sql = "UPDATE user SET forw='$forw' WHERE user_username = '$current_user'";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

    $sql = "UPDATE user SET gkp='$gkp' WHERE user_username = '$current_user'";
    $result = mysqli_query($database,$sql) or die(mysqli_error($database));

    // echo "<h2>Your forwards are: $forw.</h2>";
    // echo "<h2>Your midfielders are: $mid.</h2>";
    // echo "<h2>Your defenders are: $def.</h2>";
    // echo "<h2>Your goalkeeper is: $gkp.</h2>";
?>
    <h2>Your team has been added to your account.</h2>
    <a href = "yourteam.php">
        <button type="button" class="btn btn-primary btn-lg">View Your Team</button>
    </a>
</div>
</div>
</div>
</div>
