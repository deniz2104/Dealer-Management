<!DOCTYPE html>
<html lang="en">
<!TODO: Loader>
<!TODO: Loader pentru o prima pagina inainte de asta unde aleg intre client si (dealer/admin)>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Log in Form</title>
</head>

<body>
    <form action="login.php" method="post">
    
        <h1>Log in</h1>
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required placeholder="Introduceti numele" autocomplete="off">
        <br>

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele" autocomplete="off">
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required placeholder="example@gmail.com" autocomplete="off">
        <br>


        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required placeholder="..." autocomplete="off">
        <br>

        <label>Role:</label>
        <br>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="seller">Seller</option>
        </select>
        <button type="submit" class="btn">Log in</button>
        <p>Don't have an account?<a href="register_form.php">Register now</a></p>
    </form>
</body>

</html>