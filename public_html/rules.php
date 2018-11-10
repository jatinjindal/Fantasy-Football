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
?>
<h2> Here Be the Rules: </h2>
<ul class="nav">
    <li>1. When you log in, you can create your own fantasy team. After each Matchday, you have 2 options, continue with the same team, or create a new team for the upcoming Matchday.</li>
    <li>2. Depending upon how the players in your team perform in the EPL, each player earns certain points. Your total score for that Matchday is the sum total of the scores of all the players in your team.</li>
    <li>3. Your score starts from zero on the day you first log in. The points your chosen players might have accumulated before you added them to your team are not added to your score.</li>
    <li> 4. After each Matchday, you are required to confirm whether you're fine with your current team or you'd like to create a new one for the next Matchday. If you don't, then you won't get any points for that Matchday! Watch out or you'll fall behind in the Leaderboard! </li>
</ul>
</div>
</div>
</div>
</div>
