<h1>Forum de discution</h1>
<h4>Vous devez vous connectez !</h4>
<form class="login" action="index.php?Usagers" method="post">
	<label for="user">Nom d'usager :</label> 
	<input type="text" name="user"/><br>
	<label for="pass">Mot de passe : </label> 
	<input type="password" name="pass"/><br>
	<input type="hidden" name="action" value="authentifier"/>
	<input class="submit" type="submit" value="login"/>
</form>
<?php
    if($donnees["erreurs"] != "")
?>
    <p><?= $donnees["erreurs"] ?></p>

