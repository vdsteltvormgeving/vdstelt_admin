            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_full column_line side-shadow">
                    <?php 
                            $cid = $_POST["companyid"];
                            foreach ($cid as $bedrijfid => $waarde) {
                                $companyid = $bedrijfid;
                            }
                            if ($cid != "") {
                            $stmt6 = mysqli_prepare($link, "SELECT * FROM company WHERE companyid = $companyid");
                            mysqli_stmt_execute($stmt6);
                            mysqli_stmt_bind_result($stmt6, $companyid,$companynaam,$straatname,$huisnr,$postcode,$plaats,$algemail,$website,$kvknr,$btwnr,$ibannr,$bicnr);                        
                            while (mysqli_stmt_fetch($stmt6)){
                                echo '<h1>'.$companynaam.'</h1><p></p>';
                                echo '<p><label>Bedrijfsnummer:</label>'.$companyid.'</p>';
                                echo '<p><label>Bedrijfsnaam:</label>'.$companynaam.'</p>';
                                echo '<p><label>Adres:</label>'.$straatname.$huisnr.'</p>';
                                echo '<p><label></label>'.$postcode.' '.$plaats.'</p><hr>';
                                echo '<p><label>E-mail:</label>'.'<a href=mailto:'.$algemail.'>'.$algemail.'</a></p>';
                                echo '<p><label>Website:</label>'.'<a href="http://'.$website.'" target="_blank">'.$website.'</a></p><hr>';
                                echo '<p><label>KVK nummer:</label>'.$kvknr.'</p>';
                                echo '<p><label>BTW nummer:</label>'.$btwnr.'</p>';
                                echo '<p><label>IBAN nummer:</label>'.$ibannr.'</p>';
                                echo '<p><label>BIC nummer:</label>'.$bicnr.'</p>';
                                
                            }
                            
                            } else {echo'<div class="column_normal column_line side-shadow">
                                <h1>Not found</h1>
                                <p>Er zijn geen gegevens gevonden!</p>
                                </div>';} 
                            mysqli_stmt_free_result($stmt6); // resultset opschonen
                            mysqli_stmt_close($stmt6); // statement opruimen 
                    ?>
                <form>
                    <input type="submit" name="submit" formaction="" value="Deze klant verwijderen">
                    <submit onclick="goBack()">Terug</submit>                  
                </form>
            </div>
<?php 
    mysqli_close($link); // verbinding verbreken  
?>