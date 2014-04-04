<h1>Pokemon-tietokanta</h1>


<<<<<<< HEAD
<form class="form-horizontal" role="form" action="ulos.php" method="POST">
    <div class="form-group">
        <div class="col-md-offset-8 col-md-10">
            <button type="submit" class="btn btn-link">Kirjaudu ulos</button>
        </div>
    </div>
</form>

<div class="row">
    <form class="form-horizontal" role="form" action="omat.html" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5">
                <button type="submit" class="btn btn-primary">Omat Pokemonit</button>
=======
        <form class="form-horizontal" role="form" action="ulos.php" method="POST">
            <div class="form-group">
                <div class="col-md-offset-8 col-md-10">
                    <button type="submit" class="btn btn-link">Kirjaudu ulos</button>
                </div>
>>>>>>> 903ff75680c5c4ad256f665d5082dad55cd50c86
            </div>
        </div>
    </form>

</div>

<div class="container">
    <h1>Yleistä tietoa</h1>

    <form class="form-horizontal" role="form" action="haku2.php" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5 col-md-10">
                <button type="submit" class="btn btn-primary">Haku</button>
            </div>
        </div>
<<<<<<< HEAD
    </form>
    <form class="form-horizontal" role="form" action="lisaa2.php" method="POST">
        <div class="form-group">
            <div class="col-md-offset-5 col-md-10">
                <button type="submit" class="btn btn-primary">Lisää</button>
            </div>
=======
        
        <div class="container">
            <h1>Yleistä tietoa</h1>
            
            <form class="form-horizontal" role="form" action="haku2.html" method="POST">
                <div class="form-group">
                    <div class="col-md-offset-5 col-md-10">
                        <button type="submit" class="btn btn-primary">Haku</button>
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
                        
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach($data->pokemonit as $pokemon): ?>
                    
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
                    </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
>>>>>>> 903ff75680c5c4ad256f665d5082dad55cd50c86
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

