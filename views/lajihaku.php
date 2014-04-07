<div class="container">
    <h1>Haku</h1>
    <form class = "form-horizontal" role = "form" action = "index.php" method = "POST">
        <div class = "form-group">
            <div class = "col-md-offset-8 col-md-10">
                <button type = "submit" class = "btn btn-link">Takaisin</button>
            </div>
        </div>
    </form>

    <form class = "form-horizontal" role = "form" action = "lajiHakuControl.php" method = "POST">
        
        <div class = "form-group">
            <label for = "inputPassword1" class = "col-md-2 control-label">Nimi</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword1" name = "Nimi">
            </div>
        </div>
        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Type1</label>
            <div class = "col-md-10">
                <select name = "type1">
                    <option value = "-">-</option>
                    <option value = "Normal">Normal</option>
                    <option value = "Fighting">Fighting</option>
                    <option value = "Flying">Flying</option>
                    <option value = "Poison">Poison</option>
                    <option value = "Ground">Ground</option>
                    <option value = "Rock">Rock</option>
                    <option value = "Bug">Bug</option>
                    <option value = "Ghost">Ghost</option>
                    <option value = "Steel">Steel</option>
                    <option value = "Fire">Fire</option>
                    <option value = "Water">Water</option>
                    <option value = "Grass">Grass</option>
                    <option value = "Electric">Electric</option>
                    <option value = "Psychic">Psychic</option>
                    <option value = "Ice">Ice</option>
                    <option value = "Dragon">Dragon</option>
                    <option value = "Dark">Dark</option>
                    <option value = "Fairy">Fairy</option>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Type2</label>
            <div class = "col-md-10">
                <select name = "type2">
                    
                    <option value = "-">-</option>
                    <option value = "Normal">Normal</option>
                    <option value = "Fighting">Fighting</option>
                    <option value = "Flying">Flying</option>
                    <option value = "Poison">Poison</option>
                    <option value = "Ground">Ground</option>
                    <option value = "Rock">Rock</option>
                    <option value = "Bug">Bug</option>
                    <option value = "Ghost">Ghost</option>
                    <option value = "Steel">Steel</option>
                    <option value = "Fire">Fire</option>
                    <option value = "Water">Water</option>
                    <option value = "Grass">Grass</option>
                    <option value = "Electric">Electric</option>
                    <option value = "Psychic">Psychic</option>
                    <option value = "Ice">Ice</option>
                    <option value = "Dragon">Dragon</option>
                    <option value = "Dark">Dark</option>
                    <option value = "Fairy">Fairy</option>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Base HP >=</label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "HP">
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Base Attack >= </label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Attack">
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Base Defense >= </label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Defense">
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Base Sp. Attack >= </label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "SpAttack">
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Base Sp. Defense >= </label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "SpDefense">
            </div>
        </div>

        <div class = "form-group">
            <label for = "inputPassword2" class = "col-md-2 control-label">Base Speed >= </label>
            <div class = "col-md-10">
                <input type = "text" class = "form-control" id = "inputPassword2" name = "Speed">
            </div>
        </div>
        
        <div class = "form-group">
            <div class = "col-md-offset-2 col-md-10">
                <button type = "submit" class = "btn btn-default">Hae</button>
            </div>
        </div>
    </form>
</div>

