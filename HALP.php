<html>
    Categorie wijzigen:  <form METHOD="post" ACTION ="">
        <SELECT NAME="categorie_wijzigen">
            <option value="Select Category">Select</option>
            <option value="website">Category1</option>
            <option value="cms">CMS</option>
            <option value="hosting">Hosting</option>
        </SELECT>
        <input type="submit" value="Verander Category" name="change_category">
    </form>

    <form method="POST" ACTION="">
        <input type="text" name="Text">
        <input type="submit" value="yay/nay" name="yay/nay">
    </form>

    <?php
    if (isset($_POST["change_category"])) {
        print($_POST["categorie_wijzigen"]);
    }
    if (isset($_POST["yay/nay"])) {
        print($_POST["Text"]);
    }
    ?>