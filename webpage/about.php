<!DOCTYPE html>
<html>
<head>
    <title>О себе</title>
    <style>
        body {
            margin: 0;
            font-family: 'Helvetica', sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: black;
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
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>О себе</h1>
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
            <p>Привет! Я Алексей, и это моя личная страница. Я начинающий DevOps инженер и увлекаюсь автоматизацией процессов и облачными технологиями.</p>
            <p>В свободное время я также учусь новым навыкам, читаю книги и занимаюсь спортом.</p>
        </section>
    </main>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Моя личная страница</p>
    </footer>
</div>
</body>
</html>