            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_full column_line side-shadow">
                <h1>Nieuwe klant aanmaken</h1>
                <form method="POST" action="">
                    <table>
                    <?php 
                    $stmt7 = ("SELECT companyID FROM company");
                    
                    if ($resultaat=mysqli_query($link,$stmt7)){
                    $rowcount=mysqli_num_rows($resultaat);
                    echo('<p>Laatste companyID = '.$rowcount.'</p>');
                    }                        
                    mysqli_free_result($resultaat); // resultset opschonen
                    $nieuweID = $rowcount+1;

                    echo '<tr><td><label>Bedijfsid:</label><input type="text" name=companyid["'.$nieuweID.'"] value="'.$nieuweID.'"DISABLED></td>';
                    ?>
                    <td><label>Bedrijfsnaam: </label><input type="text" name="bedrijfsnaam"></td></tr>
                    <tr><td><label>Straat: </label><input type="text" name="straatnaam"></td>
                    <td><label>Huisnummer: </label><input type="text" name="huisnummer"></td></tr>
                    <tr><td><label>Postcode: </label><input type="text" name="postcode"></td>
                    <td><label>Plaats: </label><input type="text" name="plaats"></td></tr>
                    <tr><td><label>Algemene e-mail: </label><input type="text" name="alg_email"></td>
                    <td><label>Website: </label><input type="text" name="website"></td></tr>
                    <tr><td><label>Kvk nummer: </label><input type="text" name="kvk_nr"></td>
                    <td><label>BTW nummer: </label><input type="text" name="btw_nr"></td></tr>
                    <tr><td><label>IBAN nummer: </label><input type="text" name="iban_nr"></td>
                    <td><label>BIC nummer: </label><input type="text" name="bic_nr"></td></tr>
                    </table>
                    <?php 
                    if(isset($_POST["submitklant"])){ 
                        $companyid = $nieuweID;
                        $companynaam = $_POST["bedrijfsnaam"];
                        $straatname = $_POST["straatnaam"];
                        $huisnr = $_POST["huisnummer"];
                        $postcode = $_POST["postcode"];
                        $plaats = $_POST["plaats"];
                        $algemail = $_POST["alg_email"];
                        $website = $_POST["website"];
                        $kvk_nr = $_POST["kvk_nr"];
                        $btw_nr = $_POST["btw_nr"];
                        $iban_nr = $_POST["iban_nr"];
                        $bic_nr = $_POST["bic_nr"];
                    if ($companyid == "" || $companynaam == "" || $straatname == "" || $huisnr == "" || $postcode == "" || $plaats == "" || $algemail == "" || $website == "" || $kvk_nr == "" || $btw_nr == "" || $iban_nr == "" || $bic_nr == ""){
                    //Als alles leeg is.
                    } else {    
                        $stmt8 = mysqli_prepare($link,"INSERT INTO company (`companyID`,`companynaam`,`straatname`,`huis_nr`,`postcode`,`plaats`,`alg_email`,`website`,`kvk_nr`,`btw_nr`,`iban_nr`,`bic_nr`) VALUES ('".$companyid."','".$companynaam."','".$straatname."','".$huisnr."','".$postcode."','".$plaats."','".$algemail."','".$website."','".$kvk_nr."','".$btw_nr."','".$iban_nr."','".$bic_nr."')");
                        mysqli_stmt_execute($stmt8);
                        echo '<p>Klant is succesvol aangemaakt</p>';
                        mysqli_stmt_free_result($stmt8); // resultset opschonen
                        mysqli_stmt_close($stmt8); // statement opruimen 
                    }}
                    ?>
                    <input type="submit" name="submitklant" value="Klant toevoegen">
                    <submit onclick="goBack()">Terug</submit>                  
                </form>
            </div>
<?php 
    mysqli_close($link); // verbinding verbreken  
?>