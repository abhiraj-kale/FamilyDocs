<html>
    <h1 style="margin-left: 40%; margin-right:auto;margin-top:100px">An Error Occured...</h1>
    <h4 style="margin-left: 40%; margin-right:auto;"><?php 
        if (isset($_GET['error']) && !empty($_GET['error'])) {
            # code...
            echo $_GET['error'];
        }
    ?></h4>
    <form action="home.php">
    <input type="submit"  value="Go back" style="margin-left: 40%; margin-right:auto;">
    </form>
</html>
