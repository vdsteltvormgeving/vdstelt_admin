            <div class="column_small column_line side-shadow">
                <h1>Welkom</h1>
                <p style="color:lightgrey; font-size:10px;">Saturday, December 13 2014, 1:13</p>
                <p>Goedendag <b>Sander</b>, Hoe gaat het met u?</p>
                <p>Dit adminstratie systeem staat weer voor uw klaar.</p>
                <?php
                   /*$mydate=getdate(date("U"));
                   for($i=0; $i<$mydate[hours];$i++){
                       $uur = $mydate[hours] + 1;
                   }
                    echo "<p> $mydate[weekday], $mydate[month] $mydate[mday] $mydate[year], $mydate[hours]+1 :$mydate[minutes] </p>";
                    */
                    ?>
            </div>
            <?php
                include('include/functies.php'); 
            ?>
            <div class="column_normal column_line side-shadow">
                <h1>Home</h1>
                <p></p>
                <table>
                    <tr>
                        <td>U heeft <?php echo $count;  if($count > 1){echo ' openstaande facturen';}else{echo ' openstaand factuur';}?></td>
                    </tr>
                    <th>Factuur nummer:</th>
                    <th>Factuur titel:</th>
                        <?php
                            while (mysqli_stmt_fetch($stmt1)){
                                echo '<tr><td>'.$factuurid.'</td>';
                                echo '<td>'.$factuurtitel.'</td></tr>';
                            }
                        ?>
                </table>
                <a href="Klanten">Klanten overzicht</a><br>
                <a href="Factuur">Facturen overzicht</a>
            </div>
<?php 
    mysqli_stmt_free_result($stmt1); // resultset opschonen
    mysqli_stmt_close($stmt1); // statement opruimen
    mysqli_close($link); // verbinding verbreken  
?>