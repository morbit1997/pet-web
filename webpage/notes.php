<?php
// Подключение к базе данных
$connection = mysqli_connect('localhost', 'root', '12345678', 'testdb');

// Проверка соединения
if (!$connection) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Обработка отправки формы
if (isset($_POST['submit'])) {
    $note = $_POST['note'];
    $sql = "INSERT INTO notes (note) VALUES ('$note')";
    if (mysqli_query($connection, $sql)) {
        echo "Заметка успешно добавлена!";
    } else {
        echo "Ошибка: " . mysqli_error($connection);
    }
}

// SQL-запрос для извлечения данных
$sql = "SELECT * FROM notes ORDER BY id DESC";
$result = mysqli_query($connection, $sql);

// Закрываем соединение с базой данных
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Доска заметок</title>
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
        
        textarea {
        resize: none;
        }

        textarea.fixed-size {
            width: 300px;
            height: 100px;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Добро пожаловать на Доску заметок</h1>
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
            <h2>Оставьте свою заметку</h2>
            <form method="post">
                <textarea name="note" placeholder="Введите заметку" class="fixed-size"></textarea>
                <button type="submit" name="submit">Добавить</button>
            </form>
        </section>
        <section>
            <h2>Заметки</h2>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p>{$row['note']}</p>";
            }
            ?>
        </section>
    </main>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Доска заметок</p>
    </footer>
</div>
</body>
</html>
