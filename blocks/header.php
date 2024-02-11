<header>
    <a href="/" class="logo">Blog Master</a>
    <nav>
        <a href="/">Главная</a>
        <?php if (isset($_COOKIE['auth'])): ?>
            <a href="/users.php">Список пользывателей</a>
            <a href="/login.php" class="btn">Кабинет пользывателя</a>
        <?php else : ?>
            <a href="/login.php" class="btn">Войти</a>
            <a href="/register.php" class="btn">Регистрация</a>
        <?php endif; ?>
    </nav>
</header>