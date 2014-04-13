<h1>Pokemon-tietokanta</h1>

<form class="form-horizontal" role="form" action="ulos.php" method="POST">
    <div class="form-group">
        <div class="col-md-offset-8 col-md-10">
            <button type="submit" class="btn btn-link">Kirjaudu ulos</button>
        </div>
    </div>
</form>

<div class="row">
    <form class="form-horizontal" role="form" action="omat.php" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5">
                <button type="submit" class="btn btn-primary">Omat Pokemonit</button>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <h1>Yleistä tietoa</h1>

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
                <th>Tyyppi1</th>
                <th>Tyyppi2</th>
                <th>Base HP</th>
                <th>Base Attack</th>
                <th>Base Defense</th>
                <th>Base Sp. Attack</th>
                <th>Base Sp. Defense</th>
                <th>Base Speed</th>
                <!-- Lajien muokkaus ja poistaminen vain adminille -->
                <?php if($_SESSION['kirjautunut'] == 1) : ?>
                <th>Muokkaa</th>
                <th>Poista</th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data->pokemonit as $pokemon): ?>

                <tr>
                    <td><?php echo $pokemon->getId() ?></td>
                    <td><?php echo $pokemon->getName() ?></td>
                    <td><?php echo $pokemon->getType1() ?></td>
                    <td><?php echo $pokemon->getType2() ?></td>
                    <td><?php echo $pokemon->getHP() ?></td>
                    <td><?php echo $pokemon->getAtk() ?></td>
                    <td><?php echo $pokemon->getDef() ?></td>
                    <td><?php echo $pokemon->getSpAtk() ?></td>
                    <td><?php echo $pokemon->getSpDef() ?></td>
                    <td><?php echo $pokemon->getSpd() ?></td>
                    <?php if($_SESSION['kirjautunut'] == 1) : ?>
                    <td><a href="lomake2.php?toiminto=muokkaa&id=<?php echo $pokemon->getId() ?>">Muokkaa</a></td>
                    <td><a href="poistoControl.php?id=<?php echo $pokemon->getId() ?>">Poista</a></td>
                    <?php endif; ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


