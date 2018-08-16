<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <title>Easy Chat</title>
</head>
<body>

    <header>
        <div class="header__tile_black"></div>
        <div class="header__tile_green"></div>
        <div class="header__tile_yellow"></div>
        <div class="header__tile_white"></div>
        <div class="header__tile_blue"></div>
        <div class="header__tile_black"></div>
        <div class="header__tile_green"></div>
        <div class="header__tile_yellow"></div>
        <div class="header__tile_white"></div>
        <div class="header__tile_blue"></div>
    </header>

    <h1 class="title">Easy Chat</h1>

    <section class="main-content">

        <div class="auth" id="auth">
            <form class="auth__form" id="auth-form">
                <div>
                    <label class="auth__label" for="user">Enter your name</label><br>
                    <input class="auth__input" type="text" name="username" id="user">
                </div>
                <div class="auth__error" id="user-err">Enter username</div>
                <div>
                    <label class="auth__label" for="pass">Enter your password</label><br>
                    <input class="auth__input" type="password" name="password" id="pass">
                </div>
                <div class="auth__error" id="pass-err">Invalid password</div>
                <input class="auth__btn" type="submit" value="Submit">
                <div class="auth__shadow"></div>
            </form>
        </div>

        <div class="chat" id="chat">
            <div class="chat__out" id="msg-area"></div>
            <form class="chat__form" id="chat-form">
                <input class="chat__in" type="text" name="message" id="msg" title="Your message">
                <input class="chat__btn" type="submit" value="Send">
            </form>
        </div>

        <div class="db-error" id="db-err"><h4>Database error</h4></div>

    </section>

    <script src="/js/jquery-3.3.1.js"></script>
    <script src="/js/ajax-requests.js"></script>

</body>
</html>