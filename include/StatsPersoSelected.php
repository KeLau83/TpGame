<h3> Vous avez choisi <?= $charac1 -> getName() ?></h3>
<h4> Sa classe est <?= $charac1 -> getClass() ?> </h4>
<h4>Il lui reste <?= $charac1 -> gethealthPoints() ?> pts de vie</h4>
<h5>Il est actuellement <?= $charac1 -> getLVL() ?> LVL</h5>
<h5>Il a <?= $charac1 -> getEXP() ?> d'exp et il lui reste <?= $charac1 -> getExpRequire() ?> d'exp pour LVL up </h5>
<h5>Il a  <?= $charac1 -> getStrength() ?> de force </h5>
<a href="resetChoices.php">Changer de personnage</a>
</br></br></br>