<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 ">
            <form method="POST">
                <div class="form-row">
                    <div class="col-4">
                        <h4>
                            <?= $fighter1['name'] ?>
                        </h4>
                        <div> <?= $fighter1['damageRecieve'] ?> </div>
                        <div> <?= $fighter1['hp'] ?> PV </div>
                        <div> <?= $fighter1['malus'] ?> </div>
                    </div>
                    <div class="col-4">
                        <h4>
                            <?= $fighter2['name'] ?>
                        </h4>
                        <div> <?= $fighter2['damageRecieve'] ?> </div>
                        <div> <?= $fighter2['hp'] ?> PV </div>
                        <div> <?= $fighter2['malus'] ?> </div>
                    </div>
                </div>
        </div>
        </br>
        <div>
            <?php if ($winner == "Égalité") { ?>
                <h3>
                    <div> Oh Mon Dieu !!!!!!!!!!!!!!!!!!!!!Égalité !!!!!</div>
                    <div>2 en moins ça dégage qu'on m'emmène les suivants !!!</div>
                </h3>
            <?php } elseif ($winner) { ?>
                <h1>
                    <div>
                        Le grand gagnant n'est autre que <?= $winner ?>
                    </div>
                    <div>
                        Il poursuit son aventure et regagne 50 pts de vie!
                    </div>
                </h1>
            <?php } else { ?>
                <button type="submit" class="btn btn-dark">Combattez!</button>
            <?php } ?>
            <a href="./resetChoices.php">Home</a>
        </div>
    </div>
    </form>
</div>
<div class="col-2"></div>
</div>
</div>