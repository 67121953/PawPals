<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Actor Garage')</title>
    <!-- เรียกใช้ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font ทรงสปอร์ต -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;0,700;1,800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0d0f12;
            color: #e0e6ed;
            font-family: 'Kanit', sans-serif;
        }

        /* หัวข้อแนว Racing */
        .racing-title {
            font-style: italic;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(45deg, #00ff88, #00e5ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(0, 255, 136, 0.4);
        }

        /* ตกแต่งตาราง */
        .table {
            --bs-table-bg: #161b22;
            --bs-table-color: #e0e6ed;
            border-color: #30363d;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: #21262d;
            color: #00ff88;
            font-style: italic;
            border-bottom: 2px solid #00ff88;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        /* ปุ่มกดดีไซน์สปอร์ตเอียง */
        .btn-primary {
            background: #00ff88;
            color: #0d0f12;
            font-weight: 700;
            font-style: italic;
            border: none;
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background: #00cc6c;
            color: #0d0f12;
            box-shadow: 0 0 20px #00ff88;
            transform: skewX(-10deg) scale(1.05);
        }

        .btn-danger {
            background: transparent;
            color: #ff0055;
            border: 2px solid #ff0055;
            font-weight: 700;
            font-style: italic;
            transition: all 0.2s;
        }
        .btn-danger:hover {
            background: #ff0055;
            color: #fff;
            box-shadow: 0 0 15px #ff0055;
            transform: skewX(-10deg);
        }

        /* รูปถ่ายมีกรอบเรืองแสง */
        .img-thumbnail {
            background-color: transparent;
            border: 2px solid #00ff88;
            box-shadow: 0 0 8px rgba(0, 255, 136, 0.4);
            transition: transform 0.3s ease;
        }
        .img-thumbnail:hover {
            transform: scale(1.2) rotate(3deg);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>