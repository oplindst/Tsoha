
<form class="form-horizontal" role="form" action="ulos.php" method="POST">
    <div class="form-group">
        <div class="col-md-offset-8 col-md-10">
            <button type="submit" class="btn btn-link">Kirjaudu ulos</button>
        </div>
    </div>
</form>

<form class = "form-horizontal" role = "form" action = "omat.php" method = "POST">
    <div class = "form-group">
        <div class = "col-md-offset-8 col-md-10">
            <button type = "submit" class = "btn btn-link">Takaisin</button>
        </div>
    </div>
</form>

<div class="container">
    <h1>Omat Tiimit</h1>

    <form class = "form-horizontal" role = "form" action = "uusiTiimi.php" method = "POST">
        <div class = "form-group">
            <label for = "inputUusiTiimi" class = "col-md-2 control-label"></label>
            <div class = "col-lg-push-1 col-md-2">
                <input type = "text" class = "form-control" id = "inputEmail1" name = "Nimi" value = <?php echo $data->nimi; ?>>
            </div>
            <div class = "col-lg-push-1 col-md-3">
                <button type = "submit" class = "btn btn-primary">Lisää uusi tiimi</button>
            </div>
        </div>
    </form>
    <BR>
    <?php foreach ($data->tiimit as $tiimi): ?>
    <h3><?php echo $tiimi->getNimi() ?></h3>
    <form class = "form-horizontal" role = "form" action = "poistaTiimi.php" method = "POST">
        <div class = "form-group">
            <label for = "tiimi" class = "col-md-2 control-label"></label>
            <div class = "col-md-10">
                <input type = "hidden" class = "form-control" id = "tiimi" name = "tiimi" value = <?php echo $tiimi->getId(); ?>>
            </div>
        </div>
        <div class = "form-group">
            <div class ="col-md-offset-11">
                <button type = "submit" class = "btn btn-primary">Poista tiimi</button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nimi</th>
                <th>Taso</th>
                <th>HP</th>
                <th>Attack</th>
                <th>Defense</th>
                <th>Sp. Attack</th>
                <th>Sp. Defense</th>
                <th>Speed</th>
                <th>Poista</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->tiimienjasenet[$tiimi->getId()] as $pokemon): ?>
            <tr>
                <td><?php echo $pokemon->getLaji() ?></td>
                <td><?php echo $pokemon->getName() ?></td>
                <td><?php echo $pokemon->getTaso() ?></td>
                <td><?php echo $pokemon->getHP() ?></td>
                <td><?php echo $pokemon->getAtk() ?></td>
                <td><?php echo $pokemon->getDef() ?></td>
                <td><?php echo $pokemon->getSpAtk() ?></td>
                <td><?php echo $pokemon->getSpDef() ?></td>
                <td><?php echo $pokemon->getSpd() ?></td>
                <td><a href="tiimistaPoisto.php?poke=<?php echo $pokemon->getId() ?>&tiimi=<?php echo $tiimi->getId() ?>">Poista</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>


    </table>

    <form class = "form-horizontal" role = "form" action = "lisaaTiimiin.php" method = "POST">
        <div class = "form-group">
            <div class = "col-md-9">
                <select name = "pokemon">

                    <?php foreach ($data->pokemonit as $pokemon): ?>
                    <option value ="<?php echo $pokemon->getId(); ?>"><?php echo $pokemon->getName(); ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class = "form-group">
            <label for = "tiimi" class = "col-md-2 control-label"></label>
            <div class = "col-md-10">
                <input type = "hidden" class = "form-control" id = "tiimi" name = "tiimi" value = <?php echo $tiimi->getId(); ?>>
            </div>
        </div>
        <div class = "form-group">
            <div class ="col-md-10">
                <button type = "submit" class = "btn btn-primary">Lisää tiimin</button>
            </div>
        </div>
    </form>
    <?php endforeach; ?>
</div>
