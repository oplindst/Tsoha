<h1>Pokemon-tietokanta</h1>

<form class="form-horizontal" role="form" action="ulos.php" method="POST">
    <div class="form-group">
        <div class="col-md-offset-8 col-md-10">
            <button type="submit" class="btn btn-link">Kirjaudu ulos</button>
        </div>
    </div>
</form>
<h4>Tervetuloa Pokemon-tietokantaan! Täällä voit pitää kirjaa omista Pokemoneistasi tai muuten vain hakea tietoa Pokemoneista. </h4>
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

    <h4> Tästä löydät Pokemonlajien tietoja: muun muassa lajikohtaisia tyyppitietoja ja <a href="http://bulbapedia.bulbagarden.net/wiki/Base_stats">Base stat</a>-arvoja.</h4>
    <form class="form-horizontal" role="form" action="lajiHakulomake.php" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5 col-md-10">
                <button type="submit" class="btn btn-primary">Haku</button>
            </div>
        </div>
    </form>
    <?php if ($_SESSION['kirjautunut'] == 1) : ?>
        <form class="form-horizontal" role="form" action="lajiLomake.php?toiminto=lisaa" method="POST">
            <div class="form-group">
                <div class="col-md-offset-5 col-md-10">
                    <button type="submit" class="btn btn-primary">Lisää</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><a href="index.php">#</th>
                <th><a href="index.php?order=nimi">Nimi</th>
                <th><a href="index.php?order=type1">Tyyppi1</th>
                <th><a href="index.php?order=type2">Tyyppi2</th>
                <th><a href="index.php?order=bhp desc">Base HP</th>
                <th><a href="index.php?order=batk desc">Base Attack</th>
                <th><a href="index.php?order=bdef desc">Base Defense</th>
                <th><a href="index.php?order=bspatk desc">Base Sp. Attack</th>
                <th><a href="index.php?order=bspdef desc">Base Sp. Defense</th>
                <th><a href="index.php?order=bspd desc">Base Speed</th>
                <!-- Lajien muokkaus ja poistaminen vain adminille -->
                <?php if ($_SESSION['kirjautunut'] == 1) : ?>
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
                    <?php if ($_SESSION['kirjautunut'] == 1) : ?>
                        <td><a href="lajiLomake.php?toiminto=muokkaa&id=<?php echo $pokemon->getId() ?>">Muokkaa</a></td>
                        <td><a href="poistoControl.php?id=<?php echo $pokemon->getId() ?>">Poista</a></td>
                    <?php endif; ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


