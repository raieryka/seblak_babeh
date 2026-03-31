<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>

    <meta http-equiv="refresh" content="3;url={{ route('home') }}">

    <style>
        body {
            background: #5a0000;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        h1 {
            font-size: 40px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>
        Halo, {{ auth()->user()->name }} 👋
    </h1>

</body>
</html>