<div class="container">
    <h1><?php echo $data->otsikko; ?></h1>
    <form class = "form-horizontal" role = "form" action = "omat.php" method = "POST">
        <div class = "form-group">
            <div class = "col-md-offset-8 col-md-10">
                <button type = "submit" class = "btn btn-link">Takaisin</button>
            </div>
        </div>
    </form>
    
    <h4>Täytä Pokemonisi tiedot tähän. Katso tarvittaessa lisätietoa <a href="http://bulbapedia.bulbagarden.net/wiki/IV">IV</a>- <a href="ja http://bulbapedia.bulbagarden.net/wiki/EV">EV</a>-arvoista ja <a href="http://bulbapedia.bulbagarden.net/wiki/Nature">Natureista</a>. </h4>
    <h4>Kaikkien Pokemonlajien tietoja ei välttämättä löydy tietokannasta, tällaista et siis pysty lisäämään itsellesi. </h4>

    <form class = "form-horizontal" role = "form" action = "omaLomakeControl.php" method = "POST">
        <div class = "form-group">
            <label for = "inputEmail1" class = "col-md-2 control-label">Lajinumero (1-718)</label>
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
            <label for = "inputPassword2" class = "col-md-2 control-label">HP (1-1000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "HP" value = <?php echo $data->hp; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Attack (1-1000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Attack" value = <?php echo $data->atk; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Defense (1-1000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Defense" value = <?php echo $data->def; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Sp. Attack (1-1000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "SpAttack" value = <?php echo $data->spatk; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Sp. Defense (1-1000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "SpDefense" value = <?php echo $data->spdef; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Speed (1-1000)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Speed" value = <?php echo $data->spd; ?>>
            </div>
        </div>

        <?php foreach ($data->ivvalues as $label => $value): ?>
            <div class = "form-group">
                <label for = "inputIVs" class = "col-md-2 control-label"><?php echo $label; ?></label>
                <div class = "col-md-10">
                    <select name = "<?php echo $label; ?>">
                        <?php if ($data->otsikko === 'Muokkaa' || !empty($data->virheet)) : ?>
                            <option selected ="<?php echo $data->ivvalues[$label]; ?>"><?php echo $data->ivvalues[$label]; ?></option>
                        <?php endif; ?>
                        <?php for ($x = 0; $x <= 31; $x++) : ?>
                            <option value = "<?php echo $x; ?>"><?php echo $x; ?></option>
                        <?php endfor; ?>


                    </select>
                </div>
            </div>
        <?php endforeach ?>

        <?php foreach ($data->evvalues as $label => $value): ?>
            <div class = "form-group">
                <label for = "inputEVs" class = "col-md-2 control-label"><?php echo $label; ?></label>
                <div class = "col-md-10">
                    <select name = "<?php echo $label; ?>">
                        <?php if ($data->otsikko === 'Muokkaa' || !empty($data->virheet)) : ?>
                            <option selected ="<?php echo $value; ?>"><?php echo $value; ?></option>
                        <?php endif; ?>
                        <?php for ($x = 0; $x <= 255; $x++) : ?>
                            <option value = "<?php echo $x; ?>"><?php echo $x; ?></option>
                        <?php endfor; ?>


                    </select>
                </div>
            </div>
        <?php endforeach ?>

        <div class = "form-group">
            <label for = "inputPassword1" class = "col-md-2 control-label">Nature</label>
            <div class = "col-md-10">
                <select name = "Nature">
                    <?php if ($data->otsikko === 'Muokkaa' || !empty($data->virheet)) : ?>
                        <option selected ="<?php echo $data->nature; ?>"><?php echo $data->nature; ?></option>
                    <?php endif; ?>
                    <?php foreach ($data->natures as $nature) : ?>
                        <option value = "<?php echo $nature; ?>"><?php echo $nature; ?></option>
                    <?php endforeach; ?>


                </select>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword1" class = "col-md-2 control-label">Kommentti (Max. 50 merkkiä)</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword1" name = "Kommentti" value =<?php echo $data->kommentti; ?>>
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
