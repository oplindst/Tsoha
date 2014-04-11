<div class="container">
    <h1>Rekisteröityminen</h1>
    <form class = "form-horizontal" role = "form" action = "index.php" method = "POST">
        <div class = "form-group">
            <div class = "col-md-offset-8 col-md-10">
                <button type = "submit" class = "btn btn-link">Takaisin</button>
            </div>
        </div>
    </form>

    <form class = "form-horizontal" role = "form" action = "rekistControl.php" method = "POST">
        
        <div class = "form-group">
            <label for = "inputPassword1" class = "col-md-2 control-label">Käyttäjätunnus</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword1" name = "Tunnus" placeholder="Tunnus" value = <?php echo $data->Tunnus; ?>>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Salasana</label>
            <div class = "col-md-10">
                <input type = "password" class = "form-control" id = "inputPassword2" name = "Sala1" placeholder="Salasana">
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword3" class = "col-md-2 control-label">Salasana uudestaan</label>
            <div class = "col-md-10">
                <input type = "password" class = "form-control" id = "inputPassword2" name = "Sala2" placeholder="Salasana">
            </div>
        </div>
        
        <div class = "form-group">
            <div class = "col-md-offset-2 col-md-10">
                <button type = "submit" class = "btn btn-default">Rekisteröidy</button>
            </div>
        </div>
    </form>
</div>

