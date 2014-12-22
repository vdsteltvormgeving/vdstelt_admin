            <div class="column_small column_line side-shadow">
                <h1>Welkom</h1>
                    <?php
                        date_default_timezone_set('Europe/Amsterdam');
                        setlocale(LC_ALL,"nl_NL.UTF8");
                    ?>
                <p style="color:lightgrey; font-size:10px;"><?php echo(strftime("%A %d %B %Y %X")); ?></p>
                <p>Goedendag <b>Sander</b>, Hoe gaat het met u?</p>
                <p>Dit adminstratie systeem staat weer voor uw klaar.</p>
            </div>
            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_normal column_line side-shadow">
                <h1>Facturen</h1>
                <p>U heeft 
                    <?php 
                        // Aantal openstaande facturen
                        $stmt = mysqli_prepare($link, "SELECT COUNT(factuurstatus) AS open_factuur FROM factuur");
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $count);
                        mysqli_stmt_fetch($stmt);
                        echo $count;  if($count > 1){echo ' openstaande facturen';}else{echo ' openstaand factuur';}
                        mysqli_stmt_free_result($stmt); // resultset opschonen
                        mysqli_stmt_close($stmt); // statement opruimen
                    ?>
                </p>
                <table>
                    <th>Bedrijfsnaam:</th>
                    <th>Factuurnummer:</th>
                        <?php
                            //Factuur ID en Factuur titel
                            $stmt1 = mysqli_prepare($link, "SELECT c.companynaam, f.factuurnr FROM company AS c JOIN factuur AS f WHERE f.factuurstatus = 'Open'");
                            mysqli_stmt_execute($stmt1);
                            mysqli_stmt_bind_result($stmt1, $companynaam, $factuurnr);
                            while (mysqli_stmt_fetch($stmt1)){
                                echo '<tr><td>'.$companynaam.'</td>';
                                echo '<td>'.$factuurnr.'</td></tr>';
                            }
                            mysqli_stmt_free_result($stmt1); // resultset opschonen
                            mysqli_stmt_close($stmt1); // statement opruimen
                        ?>
                </table>
            </div>
            <div class="column_small column_line side-shadow">
                <h1>Menu</h1>
                <form>
                <input type="submit"  name="submit" formaction="Klanten" value="Klantenoverzicht"><br><br>
                <input type="submit" name="submit" formaction="Facturen" value="Facturenoverzicht">
                </form>
            </div>
            <blockquote>"Nieuwe item"</blockquote>
<?php 
    mysqli_close($link); // verbinding verbreken  
?>