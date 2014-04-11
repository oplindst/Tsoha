<form class="form-horizontal" role="form" action="ulos.php" method="POST">
    <div class="form-group">
        <div class="col-md-offset-8 col-md-10">
            <button type="submit" class="btn btn-link">Kirjaudu ulos</button>
        </div>
    </div>
</form>

<form class = "form-horizontal" role = "form" action = "index.php" method = "POST">
    <div class = "form-group">
        <div class = "col-md-offset-8 col-md-10">
            <button type = "submit" class = "btn btn-link">Takaisin</button>
        </div>
    </div>
</form>

<div class="container">
    <h1>Omat Pokemonit</h1>

    <form class="form-horizontal" role="form" action="lajiHakulomake.php" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5 col-md-10">
                <button type="submit" class="btn btn-primary">Haku</button>
            </div>
        </div>
    </form>
    <form class="form-horizontal" role="form" action="lomake2.php?toiminto=lisaa" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5 col-md-10">
                <button type="submit" class="btn btn-primary">Lisää</button>
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
                <th>Muokkaa</th>
                <th>Poista</th>

            </tr>
        </thead>

        <tbody>
            <?php foreach ($data->pokemonit as $pokemon): ?>

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
                    <td><a href="lomake2.php?toiminto=muokkaa&id=<?php echo $pokemon->getId() ?>">Muokkaa</a></td>
                    <td><a href="poistoControl.php?id=<?php echo $pokemon->getId() ?>">Poista</a></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

