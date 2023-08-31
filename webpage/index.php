<!DOCTYPE html>
<html>
<head>
    <title>Моя личная страница</title>
    <style>
        body {
            margin: 0;
            font-family: 'Helvetica', sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: black;
            position: relative; /* Добавьте это */
            min-height: 100vh;
        }
        
        /* Стиль для центрированного контейнера */
        .container {
            max-width: 800px; /* Максимальная ширина контейнера */
            margin: 0 auto; /* Автоматически центрируем контейнер */
            padding: 20px; /* Добавляем отступы */
        }
        h1 {
            font-size: 36px;
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
        }
        nav ul li a:hover {
            color: black;
            text-decoration: underline;
        }
        footer {
        position: absolute; /* Абсолютное позиционирование */
        bottom: 0; /* Размещаем внизу страницы */
        text-align: center; /* Выравнивание текста по центру */
        padding: 10px 0; /* Добавляем немного отступов */
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Hello World page</h1>
        </header>
        
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="about.php">О себе</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li><a href="notes.php">Заметки</a></li>
            </ul>
        </nav>
        
        <main>
            <section>
                <h2>Привет</h2>
                <p>Меня зовут Алексей, и это моя web-страница. Здесь я расскажу немного о себе.</p>
                <img src="homyak.jpg">
            </section>
        </main>
        
        <footer>
            <p>&copy; <?php echo date("Y"); ?> Моя личная страница</p>
        </footer>
    </div>
</body>
</html>