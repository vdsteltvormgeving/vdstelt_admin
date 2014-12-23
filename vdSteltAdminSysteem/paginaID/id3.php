            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_full column_line side-shadow">
                        <?php                        
                            $fnr = $_POST["factuurnr"];
                            foreach ($fnr as $factuur => $waarde) {
                                $factuurnr = $factuur;
                            }
                            if ($fnr != "") {
                            $stmt3 = mysqli_prepare($link, "SELECT f.factuurID, f.factuurnr, f.factuurstatus, f.factuurtitel, f.omschrijving, f.btw, f.subtotaal, f.totaal, f.datum, c.companyID, c.companynaam, c.straatname, c.huis_nr, c.postcode, c.plaats, c.iban_nr FROM factuur AS f JOIN company AS C ON f.companyID = c.companyID WHERE f.factuurnr = $factuurnr");
                            mysqli_stmt_execute($stmt3);
                            mysqli_stmt_bind_result($stmt3,$factuurid,$factuurnr,$factuurstatus,$factuurtitel,$omschrijving,$btw,$subtotaal,$totaal,$datum,$companyid,$companynaam,$straat,$huisnr,$postcode,$plaats,$iban);                        
                            mysqli_stmt_fetch($stmt3);
                            echo '<h1>'.$companynaam.'</h1>
                                    <p>Bedrijfsgegevens</p>';
                                //Bedrijfsgegevens
                                echo '<p><label>BedrijfsID:</label>'.$companyid.'</p>';
                                echo '<p><label>Bedrijfnaam:</label>'.$companynaam.'</p>';
                                echo '<p><label>Straat:</label>'.$straat.' '.$huisnr.'</p>';
                                echo '<p><label>Postcode:</label>'.$postcode.' ,'.$plaats.'</p>';
                                echo '<p><label>IBAN:</label>'.$iban.'</p><br></div>';
                                //factuur gegevens
                                echo '<div class="column_full column_line side-shadow">';
                                echo '<h1>Factuur: '.$factuurid.'</h1>';
                                echo '<p><label>Factuurnummer:</label>'.$factuurnr.'</p>';
                                echo '<p><label>Datum:</label>'.$datum.'</p>';
                                
                                if ($factuurstatus == 'Open'){
                                echo '<p><label>Status:</label><span class="statusrood"></span>'.$factuurstatus.'</p>';                               
                                }else{echo '<p><label>Status:</label><span class="statusgroen"></span>'.$factuurstatus.'</p>';}
                                
                                echo '<p><label>Titel:</label>'.$factuurtitel.'</p>';
                                echo '<p><label>Inleidende tekst:</label></p>'.'<p>'.$omschrijving.'</p>';
                                echo '</div>';
                                echo '<div class="column_full column_line side-shadow">';                              
                                echo '<table>';
                                echo '<th>Product:</th><th>Papiersoort:</th><th>Kleur:</th><th>Druk:</th><th>Afwerking:</th><th>levering:</th><th>Aantal: </th>';                            
                                mysqli_stmt_free_result($stmt3); // resultset opschonen
                                mysqli_stmt_close($stmt3); // statement opruimen
                                $stmt4 = mysqli_prepare($link, "SELECT r.factuurID,r.factuurnr,r.regelID,r.artikelID,r.volgnr,r.aantal,r.prijs,a.omschrijving,a.papiersoort,a.kleur,a.typedruk,a.afwerking,a.levering FROM factuurregel AS r JOIN artikel AS a ON r.artikelID = a.artikelID WHERE r.factuurnr = '$factuurnr'");
                                mysqli_stmt_execute($stmt4);
                                mysqli_stmt_bind_result($stmt4,$factuurid,$factuurnr,$regelid,$artikelid,$volgnr,$aantal,$prijs,$omschrijving,$papier,$kleur,$druk,$afwerking,$levering);
                                while (mysqli_stmt_fetch($stmt4)){
                                echo '<tr>'; 
                                echo '<td>'.$omschrijving.'</td>'; 
                                echo '<td>'.$papier.'</td>';
                                echo '<td>'.$kleur.'</td>';
                                echo '<td>'.$druk.'</td>';
                                echo '<td>'.$afwerking.'</td>';
                                echo '<td>'.$levering.'</td>';
                                echo '<td>'.$aantal.'</td>';
                                echo '</tr>';
                                }
                                echo '</table><br>';
                                echo '<p><label>Subtotaal:</label>€ '.$subtotaal.'</p>';
                                echo '<p><label>21% BTW:</label>€ '.$btw.'</p>';
                                echo '<p><label><strong>Totaal:</strong></label>€ '.$totaal.'</p>';
                                echo '</div>';
                                } else {echo'<div class="column_normal column_line side-shadow">
                                <h1>Not found</h1>
                                <p>Er zijn geen gegevens gevonden!</p>
                                </div>';}                        

                                mysqli_stmt_free_result($stmt4); // resultset opschonen
                                mysqli_stmt_close($stmt4); // statement opruimen
                                mysqli_close($link); // verbinding verbreken  ?>