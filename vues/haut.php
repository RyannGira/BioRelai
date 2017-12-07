<div id ='nav'>

</div>

<div class='bandeau'>
	<div class="logo">
        <a href="index.php?bioRelaiMP=accueil">
        <img src="images/search-icon.png">
        </a>
    </div>
    <div class="bienvenue">
        <?php
        if(isset($_SESSION['identification'])){
            echo "<a href='?bioRelaiMP=MonCompte'><p>Bienvenue</p><p>" . $_SESSION['identification'] . "</p></a>";
        }
        ?>
    </div>
</div>

<nav class="menuPrincipal">
	<?php
	echo $menuPrincipal;
	?>
</nav>

