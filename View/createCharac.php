<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 ">
            <h3>Créer un personnage</h3>
            <form method="Post" action="index.php?action=Create">
                <div class="form-group">
                    <label for="text">Nom</label>
                    <input type="text" name="Charac" class="form-control" id="" aria-describedby="" placeholder="Choisissez un nom">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Sélectionner une Classe</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="class">
                        <option value='WhiteWizard'> Mage Blanc</option>
                        <option value='BlackWizard'> Mage noir</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark">Sélectioner</button>
            </form>
            <a href="./resetChoices.php">Home</a>
        </div>
        <div class="col-2"></div>
    </div>
</div>