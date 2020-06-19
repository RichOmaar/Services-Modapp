<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Password Recovery</h1>
      
    <form method="POST" action="../controller/testPasswordRecovery.php">
        <table>
            <tr>
                <td>Mail:</td>
                <td><input type="text" name="mail" placeholder="<?php echo $_GET["mail"]; ?>"></td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td>Repeat Password:</td>
                <td><input type="text" name="repeat"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Recovery</button></td>
            </tr>
        </table>
    </form>
</body>
</html>