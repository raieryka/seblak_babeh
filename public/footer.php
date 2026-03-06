<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Web Seblak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* ========================= */
        /* CONTEN CONTOH */
        /* ========================= */
        .content {
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff5f5;
        }

        /* ========================= */
        /* FOOTER */
        /* ========================= */
        .footer-section {
            background: #0f0f0f;
            color: #ccc;
            padding: 60px 20px 30px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            max-width: 1200px;
            margin: auto;
        }

        .footer-col {
            flex: 1;
            min-width: 250px;
        }

        .footer-brand {
            color: #ff3c3c;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 22px;
        }

        .footer-col h3 {
            color: #fff;
            margin-bottom: 15px;
        }

        .footer-col p {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background: #1a1a1a;
            text-align: center;
            border-radius: 50%;
            margin-right: 10px;
            color: #fff;
            transition: 0.3s ease;
            text-decoration: none;
        }

        .social-icons a:hover {
            background: #ff3c3c;
            transform: translateY(-3px);
        }

        .footer-line {
            border: 1px solid #222;
            margin: 40px 0 20px;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            font-size: 14px;
            color: #888;
            max-width: 1200px;
            margin: auto;
        }
    </style>
</head>

<body>

    <!-- ========================= -->
    <!-- CONTEN HALAMAN -->
    <!-- ========================= -->
    <div class="content">
        <h1>Selamat Datang di Web Seblak 🔥</h1>
    </div>

    <!-- ========================= -->
    <!-- FOOTER -->
    <!-- ========================= -->
    <footer class="footer-section">

        <div class="footer-container">

            <div class="footer-col">
                <h2 class="footer-brand">Seblak Jeletot 🔥</h2>
                <p>
                    Menghadirkan rasa pedas yang bikin nagih.
                    Nikmati seblak original, seafood, dan ceker dengan level pedas favoritmu!
                </p>
            </div>

            <div class="footer-col">
                <h3>Hubungi Kami</h3>
                <p>📞 0812-3456-7890 (WhatsApp)</p>
                <p>📍 Jl. Raya Pedas No. 12</p>
                <p>Grobogan, Jawa Tengah</p>
            </div>

            <div class="footer-col">
                <h3>Ikuti Kami</h3>
                <div class="social-icons">
                    <a href="#">📷</a>
                    <a href="#">🎵</a>
                </div>
            </div>

        </div>

        <hr class="footer-line">

        <div class="footer-bottom">
            <p>© 2026 Seblak Jeletot. All rights reserved.</p>
            <p>Dibuat dengan ❤️ untuk pecinta pedas.</p>
        </div>

    </footer>

</body>
</html>