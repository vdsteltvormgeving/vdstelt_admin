            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_normal column_line side-shadow">
                <h1>Facturenoverzicht</h1>
                <p>Hieronder staat alle facturen</p>
                <table>
                    <th>Bedrijfsnaam:</th>
                    <th>Datum:</th>
                    <th>Nummer:</th>
                    <th>Status:</th>
                    <th>Titel:</th>
                    <th>Totaal:</th>
                        <?php
                            //Factuuroverzicht
                            $stmt2 = mysqli_prepare($link, "SELECT f.factuurID, f.factuurnr, f.factuurstatus, f.factuurtitel, f.omschrijving, f.contactpersoon, f.btw, f.subtotaal, f.totaal, f.datum, c.companynaam FROM factuur AS f JOIN company AS C ON f.companyID = c.companyID");
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $factuurid,$factuurnr,$factuurstatus,$factuurtitel,$omschrijving,$contactpersoon,$btw,$subtotaal,$totaal,$datum,$companyid);                        
                            while (mysqli_stmt_fetch($stmt2)){
                                echo '<tr>';
                                echo '<td>'.$companyid.'</td>';
                                echo '<td>'.$datum.'</td>';
                                echo '<td>'.$factuurnr.'</td>';
                                echo '<td>'.$factuurstatus.'</td>';
                                echo '<td>'.$factuurtitel.'</td>';
                                echo '<td>€ '.$totaal.'</td>';
                                echo '<td><form method="POST" action="Factuur"><input type="hidden" name=factuurnr["'.$factuurnr.'"] ><input type="submit" name="submit" value="Bekijken"></form></td>';
                                echo '</tr>';
                            }
                            mysqli_stmt_free_result($stmt2); // resultset opschonen
                            mysqli_stmt_close($stmt2); // statement opruimen                            
                        ?>
                </table><br>
                <submit onclick="goBack()">Terug</submit> 
            </div>
<?php 
    mysqli_close($link); // verbinding verbreken  
?>