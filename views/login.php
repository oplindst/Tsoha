
        <div class="container">
            <h1>Kirjautuminen</h1>
            <form class="form-horizontal" role="form" action="loginControl.php" method="POST">
                <div class="form-group">
                    <label for="inputTunnus" class="col-md-2 control-label">Käyttäjätunnus</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="inputEmail1" name="tunnus" value="<?php echo $data->kayttaja; ?>" placeholder="Tunnus">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" id="inputPassword1" name="salasana" placeholder="Salasana">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Kirjaudu sisään</button>
                    </div>
                </div>
            </form>
        </div>


