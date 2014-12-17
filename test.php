<?php
if (isset($_POST["submit"])) {
    print_r($_POST["text"]);
}
?>
<html>
    <form method="POST">
        <input type="text" name="text[]">
        <input type="text" name="text[]">
        <input type="text" name="text[]">
        <input type="submit" name="submit" formaction="">
    </form>


</html>