<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DeleteAccount.css">
    <title>PasswordHashing</title>
</head>

<body>

    <div id="container">
        <img id="UpdateAccountimg" src="Logo.png" alt="Image not found!">

        <div id="UpdateAccount">

            <form action="" method="POST" onsubmit="return ValidationFun(event)"> <br>

                <label for="inputbox" id="searchlbl"> Search User </label> <br>
                <div class="search-container">
                    <form class="search-container" action="/search" method="get">
                        <input type="text" placeholder="Search">
                        <button type="submit" class="search-icon-btn"><img class="search_icon" src="Search_icon.svg"
                                alt="Icon not fount!"></button>
                    </form>
                </div> <br> <br>

                <label for="inputbox" id="nmlbl">Full Name for Update</label>
                <input type="text" name="nm" id="nminputbox" placeholder="Name" disabled> <br><br>

                <label for="inputbox" id="maillbl">Email Address for Update</label>
                <input type="email" name="cnic" id="mailinputbox" placeholder="abc@gmail.com" disabled> <br>

                <button name="UpdateAccountbtn" id="btn" type="submit"> Delete Account </button>
            </form>
        </div>
    </div>

    <script src="DeleteAccount.js"></script>
</body>

</html>