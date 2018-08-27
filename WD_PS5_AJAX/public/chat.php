<?php
include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app'
    . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'header.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('location: index.php');
}
?>

<div class="chat" id="chat">
    <div class="chat__out" id="msg-area"></div>
    <form class="chat__form" id="chat-form">
        <input class="chat__in" type="text" name="message" id="msg" title="Your message">
        <input class="chat__btn" type="submit" value="Send">
    </form>
</div>

<form id="logout">
    <input class="logout__btn chat__btn" type="submit" value="Log Out">
</form>

<script src="/js/chat.js"></script>

<?php include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app'
    . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'footer.php' ?>