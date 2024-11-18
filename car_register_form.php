<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wanth=device-wanth, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Register Cars</title>
</head>

<body>
    <form action="car_register.php" method="post">
        <h1>Register</h1>
        <label for="marca">Marca:</label>
        <input type="text" name="marca" an="marca" required placeholder="Introduceti marca" autocomplete="off">
        

        <label for="model">Model:</label>
        <input type="text" name="model" an="model" required placeholder="Introduceti modelul" autocomplete="off">
        

        <label for="capacitate cilindrica">Capacitate cilindrica:</label>
        <input type="capacitate cilindrica" name="capacitate cilindrica" an="capacitate cilindrica" required placeholder="1999 cm3" autocomplete="off">
        


        <label for="an">An:</label>
        <input type="text" name="an" an="an" required placeholder="2024" autocomplete="off">
        

        <label for="pret">Pret:</label>
        <input type="text" name="pret" an="pret" required placeholder="75000$" autocomplete="off">

        <label>ID_Masina:</label>
        <input type="text" name="id_masina" an="id_masina" required placeholder="xx" autocomplete="off">
        <button type="submit" class="btn">Register</button>
        <p>Already having a car with a dealer assigned?<a href="dealer_auto.php">Log in</a></p>
        <p>Don't have a dealer for the car yet? <a href="register_form.php">Register dealer</a></p>
    </form>
</body>

</html>