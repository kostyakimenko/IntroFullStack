<?php include __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'header.php'; ?>

<div class="auth" id="auth">
    <form class="auth__form" id="auth-form">
        <div>
            <label class="auth__label" for="user">Enter your name</label><br>
            <input class="auth__input" type="text" name="username" id="user">
        </div>
        <div>
            <label class="auth__label" for="pass">Enter your password</label><br>
            <input class="auth__input" type="password" name="password" id="pass">
        </div>
        <input class="auth__btn" type="submit" value="Submit">
        <div class="auth__shadow"></div>
    </form>
</div>

<script src="/js/check-database.js"></script>
<script src="/js/auth.js"></script>

<?php include __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'footer.php' ?>