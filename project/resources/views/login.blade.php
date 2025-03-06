<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Получить токен</title>
</head>
<body>
<h1>Получить токен для Swagger</h1>
<form id="login-form">
    <input type="email" id="email" placeholder="Email" required>
    <input type="password" id="password" placeholder="Пароль" required>
    <button type="submit">Получить токен</button>
</form>
<p id="token"></p>

<script>
    document.getElementById('login-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        const response = await fetch('http://localhost:8001/api/swaglogin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (data.token) {
            document.getElementById('token').textContent = 'Ваш токен: ' + data.token;
        } else {
            document.getElementById('token').textContent = 'Ошибка: ' + data.error;
        }
    });
</script>
</body>
</html>
