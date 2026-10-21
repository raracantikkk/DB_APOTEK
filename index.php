
<html>

    <head>
        <title>Form Login Apotek</title>
        <style>
            body {
                background: url('src/Apotek.JPG') no-repeat center center fixed;
                background-size: cover;
                margin: 0;
                font-family: 'Open Sans', sans-serif;
            }

            fieldset {
                margin: 100 auto;
                width: 320px;
                height: 400px;
                border: 2px solid white;
                background-color: white;
            }

            label {
                font-family: tahoma;
                color: red;
            }

            input {
                position: center;
                margin: 5px;
                padding: 10px;
                width: 300px;
                height: 40px;
                border: 1px solid white;
                border-radius: 10px;
            }

            select {
                position: center;
                margin: 5px;
                padding: 10px;
                width: 300px;
                height: 40px;
                border: 1px solid white;
                border-radius: 10px;
            }

            #submit {
                color: white;
                background-color: #428df5;
            }

            #input {
                background-color: #c6cfc7;
            }
        </style>
    </head>

    <body>
        <h1 align="center"><b>APOTEK</b></h1>

        <form action="login_validasi.php" method="post">
            <fieldset>

                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "gagal") {
                        echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
                    }
                }
                ?>

                <table>
                    <p align="center"><b>LOGIN</b></p>

                    <tr>
                        <td>
                            <input name="username" type="text"
                            placeholder="Username" id="input">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input name="password" type="password"
                            placeholder="Password" id="input">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input name="login" type="submit"
                            value="LOGIN" id="submit">
                        </td>
                    </tr>

                    <tr>
                        <td align="center">
                            <a href="obat.php">CEK OBAT</a>
                        </td>
                    </tr>

                </table>

            </fieldset>
        </form>
    </body>

</html>
```
