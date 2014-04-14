<div class="container">
    <h1><?php echo $data->otsikko; ?></h1>
    <form class = "form-horizontal" role = "form" action = "omat.php" method = "POST">
        <div class = "form-group">
            <div class = "col-md-offset-8 col-md-10">
                <button type = "submit" class = "btn btn-link">Takaisin</button>
            </div>
        </div>
    </form>

    <form class = "form-horizontal" role = "form" action = "omaLomakeControl.php" method = "POST">
        <div class = "form-group">
            <label for = "inputEmail1" class = "col-md-2 control-label">Lajinumero (1-2000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputEmail1" name = "ID" value = <?php echo $data->laji; ?>>
            </div>
        </div>
        <div class = "form-group">
            <label for = "inputPassword1" class = "col-md-2 control-label">Nimi (Max. 15 merkkiä)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword1" name = "Nimi" value = <?php echo $data->nimi; ?>>
            </div>
        </div>
        
        <div class = "form-group">
            <label for = "inputPassword1" class = "col-md-2 control-label">Taso (1-100)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword1" name = "Taso" value = <?php echo $data->taso; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">HP (1-255)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "HP" value = <?php echo $data->hp; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Attack (1-255)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Attack" value = <?php echo $data->atk; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Defense (1-255)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Defense" value = <?php echo $data->def; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Sp. Attack (1-255)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "SpAttack" value = <?php echo $data->spatk; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Sp. Defense (1-255)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "SpDefense" value = <?php echo $data->spdef; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Speed (1-255)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Speed" value = <?php echo $data->spd; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label"></label>
            <div class = "col-md-10">
                <input type = "hidden" class = "form-control" id = "inputPassword2" name = "toiminto" value = <?php echo $data->submit; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label"></label>
            <div class = "col-md-10">
                <input type = "hidden" class = "form-control" id = "inputPassword2" name = "id" value = <?php echo $data->id; ?>>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-md-offset-2 col-md-10">
                <button type = "submit" class = "btn btn-default"><?php echo $data->submit; ?></button>
            </div>
        </div>
    </form>
</div>
