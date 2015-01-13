            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_normal column_line side-shadow">
                <h1>Klantenoverzicht</h1>
                <form>
                    <input type="submit" name="submit" formaction="Klant aanmaken" value="Klant aanmaken">
                </form>
                <p></p>
                <table>
                    <th>Bedrijfsnaam:</th>
                    <th>E-mail:</th>
                    <th>KVK nummer:</th>
                    <th>BTW nummer:</th>
                    <th>IBAN nummer:</th>
                    <th>BIC nummer:</th>
                    <?php 
                            $stmt5 = mysqli_prepare($link, "SELECT * FROM company");
                            mysqli_stmt_execute($stmt5);
                            mysqli_stmt_bind_result($stmt5, $companyid,$companynaam,$straatname,$huisnr,$postcode,$plaats,$algemail,$website,$kvknr,$btwnr,$ibannr,$bicnr);                        
                            while (mysqli_stmt_fetch($stmt5)){
                                echo '<tr>';
                                //Select box*
                                //echo '<td><input type="checkbox"></td>';
                                echo '<td>'.$companynaam.'</td>';
                                echo '<td>'.$algemail.'</td>';
                                echo '<td>'.$kvknr.'</td>';
                                echo '<td>'.$btwnr.'</td>';
                                echo '<td>'.$ibannr.'</td>';
                                echo '<td>'.$bicnr.'</td>';
                                echo '<td><form method="POST" action="Klant"><input type="hidden" name=companyid["'.$companyid.'"] ><input type="submit" name="submit" value="Bekijken"></form></td>';
                                echo '</tr>';
                            }
                            mysqli_stmt_free_result($stmt5); // resultset opschonen
                            mysqli_stmt_close($stmt5); // statement opruimen 
                    ?>
                </table>
                <form>
                    <!-- Input correspondent select box
                    <input type="submit" name="submit" formaction="" value="Klant verwijderen">-->
                    <submit onclick="goBack()">Terug</submit>    
                </form>
            </div>
<?php 
    mysqli_close($link); // verbinding verbreken  
?>