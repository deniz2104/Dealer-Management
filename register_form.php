<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Register</title>
</head>

<body>
    <form action="register.php" method="post">
        <h1>Register</h1>
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required placeholder="Introduceti numele">
        

        <label for="prenume">Prenume:</label>
        <input type="text" name="prenume" id="prenume" required placeholder="Introduceti prenumele">
        

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required placeholder="example@gmail.com">
        


        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required placeholder="...">
        

        <label for="id_masina">ID_Masina:</label>
        <input type="text" name="id_masina" id="id_masina" required placeholder="...">

        <label>Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="seller">Seller</option>
        </select>
        <button type="submit" class="btn">Register</button>
        <p>Already a member?<a href="dealer_auto.php">Log in</a></p>
    </form>
</body>

</html>