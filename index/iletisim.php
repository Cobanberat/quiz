<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #121212;
            font-family: Arial, sans-serif;
            color: #e0e0e0;
        }

        .contact-form {
            background-color: #1e1e1e;
            padding: 30px;
            margin: 50px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            border-radius: 8px;
        }

        .contact-form h2 {
            color: #f5f5f5;
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 28px;
        }

        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form .form-control {
            background-color: #333;
            border-radius: 5px;
            border: 1px solid #555;
            color: #fff;
            padding: 15px;
            font-size: 16px;
        }

        .contact-form .form-control::placeholder {
            color: #aaa;
        }

        .contact-form .btn {
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
        }

        .contact-form .btn:hover {
            background-color: #0056b3;
        }

        .contact-info {
            margin-top: 40px;
        }

        .contact-info .icon {
            font-size: 24px;
            color: #007bff;
            margin-right: 15px;
        }

        .contact-info p {
            margin-bottom: 15px;
            font-size: 18px;
            color: #bdbdbd;
        }

        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="contact-form">
            <h2>Bizimle İletişime Geçin</h2>
            <form>
                <div class="form-group">
                    <label for="name">İsim</label>
                    <input type="text" class="form-control" id="name" placeholder="Adınızı girin" required>
                </div>
                <div class="form-group">
                    <label for="email">E-posta</label>
                    <input type="email" class="form-control" id="email" placeholder="E-posta adresinizi girin" required>
                </div>
                <div class="form-group">
                    <label for="subject">Konu</label>
                    <input type="text" class="form-control" id="subject" placeholder="Konu" required>
                </div>
                <div class="form-group">
                    <label for="message">Mesaj</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Mesajınızı yazın" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gönder</button>
            </form>
            <div class="contact-info">
                <p><i class="bi bi-telephone icon"></i> Telefon: +90 123 456 7890</p>
                <p><i class="bi bi-envelope icon"></i> E-posta: <a href="mailto:info@example.com">info@example.com</a></p>
                <p><i class="bi bi-geo-alt icon"></i> Adres: Örnek Mahallesi, İstanbul, Türkiye</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
