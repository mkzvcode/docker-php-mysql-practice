<?php
$host = getenv('DB_HOST') ?: 'db';
$dbname = getenv('DB_NAME') ?: 'appdb';
$user = getenv('DB_USER') ?: 'appuser';
$pass = getenv('DB_PASSWORD') ?: 'apppass';
try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
    ]);
    $users = $pdo->query('SELECT id, name FROM users ORDER BY id')->fetchAll();
} catch (PDOException $e) {
    http_response_code(500);
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>PHP + MySQL</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    h1 { color: #2c3e50; }
    li { line-height: 1.8; }
  </style>
</head>
<body>
<?php if (isset($error)): ?>
  <h1>Ошибка подключения к БД</h1>
  <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php else: ?>
  <h1>PHP + MySQL: подключение прошло успешно.</h1>
  <h2>Молодца!!!!!!!!!!</h2>
  <h2>Список пользователей:</h2>
  <ul>
  <?php foreach ($users as $u): ?>
    <li><?= htmlspecialchars($u['name'], ENT_QUOTES, 'UTF-8') ?></li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
</body>
</html>
