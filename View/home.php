<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 ">
            <h1> Combat!!</h1>
        <?php if($gotAChamp){ include("./include/StatsPersoSelected.php");} ?></br>
            <form method="POST">
                <div class="form-group">
                    <label for="exampleFormControlSelect1"><?php 
                if($gotAChamp){?>
                    Choisissez votre adverssaire <?php 
                } else { ?>
                    Choisissez votre personnage <?php } ?>
                   </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="choose">
                        <option>Create</option>
                        <option>Choose</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark">Sélectioner</button>
            </form>
            
        </div>
        <div class="col-2"></div>
    </div>
</div>