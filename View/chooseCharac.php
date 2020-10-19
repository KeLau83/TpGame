<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 ">
            <form method="Post">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Sélectionner un personnage</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="Charac">

                        <?php foreach($allCharacStore as $Charac) {
                                    if($Charac -> getName() != $firstCharac) { ?>
                                        <option value ="<?= $Charac -> getId() ?>"> <?= $Charac -> getName() ?>  Il lui reste <?= $Charac ->  getHealthPoints()?> pts de vie</option>
                                    <?php } 
                                }?>

                    </select>
                    <div>
                    
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Sélectioner</button>
            </form>
            <a href="./resetChoices.php">Home</a>
        </div>
        <div class="col-2"></div>
    </div>
</div>