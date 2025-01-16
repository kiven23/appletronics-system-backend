<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .qrcode-card {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fefefe;
        }
        .qrcode-card img {
            width: 200px;
            height: 200px;
            margin-right: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .qrcode-info {
            flex-grow: 1;
        }
        .qrcode-info h2 {
            margin: 0;
            font-size: 18px;
            color: #444;
        }
        .qrcode-info p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .qrcode-info a {
            display: inline-block;
            margin-top: 5px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }
        .qrcode-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>QR Code Viewer</h1>
        <div id="qrcode-list"></div>
    </div>

    <script>
        const data = [
            {
                "qrcode": "https://www.qrcoder.co.uk/api/v4/?key=Akfpq0XtBu6nHoDMCWTg9ciQILe3JwmK&text=http%3A%2F%2F192.168.1.19%3A8081%2Fverify%3Ftoken%3DVlZaa1UyUkhSbGhPUkRBOQ%3D%3D%26key%3DSHhikA97phXxk4jCye9SPpPxr0gnJarPdFUtt779KSTANZg7DBMzHaDpvHUrgDz0ok4uBfoguOtQKJU1lerQ",
                "code": "http://192.168.1.19:8081/verify?token=VlZaa1UyUkhSbGhPUkRBOQ==&key=SHhikA97phXxk4jCye9SPpPxr0gnJarPdFUtt779KSTANZg7DBMzHaDpvHUrgDz0ok4uBfoguOtQKJU1lerQ",
                "branch": "Admin"
            },
            {
                "qrcode": "https://www.qrcoder.co.uk/api/v4/?key=Akfpq0XtBu6nHoDMCWTg9ciQILe3JwmK&text=http%3A%2F%2F192.168.1.19%3A8081%2Fverify%3Ftoken%3DVlZaa2EyUnRTak5RVkRBOQ%3D%3D%26key%3DSHhikA97phXxk4jCye9SPpPxr0gnJarPdFUtt779KSTANZg7DBMzHaDpvHUrgDz0ok4uBfoguOtQKJU1lerQ",
                "code": "http://192.168.1.19:8081/verify?token=VlZaa2EyUnRTak5RVkRBOQ==&key=SHhikA97phXxk4jCye9SPpPxr0gnJarPdFUtt779KSTANZg7DBMzHaDpvHUrgDz0ok4uBfoguOtQKJU1lerQ",
                "branch": "Agoo"
            },
            {
                "qrcode": "https://www.qrcoder.co.uk/api/v4/?key=Akfpq0XtBu6nHoDMCWTg9ciQILe3JwmK&text=http%3A%2F%2F192.168.1.19%3A8081%2Fverify%3Ftoken%3DVlZaa05HRkhTbGhpU0ZacFRUQXdPUT09%26key%3DSHhikA97phXxk4jCye9SPpPxr0gnJarPdFUtt779KSTANZg7DBMzHaDpvHUrgDz0ok4uBfoguOtQKJU1lerQ",
                "code": "http://192.168.1.19:8081/verify?token=VlZaa05HRkhTbGhpU0ZacFRUQXdPUT09&key=SHhikA97phXxk4jCye9SPpPxr0gnJarPdFUtt779KSTANZg7DBMzHaDpvHUrgDz0ok4uBfoguOtQKJU1lerQ",
                "branch": "Alaminos"
            }
        ];

        const container = document.getElementById('qrcode-list');

        data.forEach(item => {
            const card = document.createElement('div');
            card.className = 'qrcode-card';

            card.innerHTML = `
                <img src="${item.qrcode}" alt="QR Code">
                <div class="qrcode-info">
                    <h2>${item.branch}</h2>
                    <p>Verification Code:</p>
                    <a href="${item.code}" target="_blank">View Link</a>
                </div>
            `;
            container.appendChild(card);
        });
    </script>
</body>
</html>
