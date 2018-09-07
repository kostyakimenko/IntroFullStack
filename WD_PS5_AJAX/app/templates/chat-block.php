<div class="chat" id="chat">
    <?php if (!isset($_SESSION['hello_msg'])): ?>
    <div class="chat_hello">Welcome to the chat, <?= $_SESSION['user']; ?>!</div>
    <?php endif; ?>
    <div class="chat__out" id="msg-area"></div>
    <form class="chat__form" id="chat-form">
        <input class="chat__in" type="text" name="message" id="msg" title="Your message">
        <input class="chat__btn" type="submit" value="Send">
    </form>
</div>

<form id="logout">
    <input class="logout__btn chat__btn" type="submit" value="Log Out">
</form>

<script src="js/chat.js"></script>