//home.php
<?php
userbox();

$id_user = $_SESSION['id'];
?>
<div class="main content">
    <div class='calendrier'>
        <?php
		include ('gestionnaire.php');
        ?>
    </div>
</div>
