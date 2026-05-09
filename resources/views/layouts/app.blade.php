<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1 0 auto; /* هذا الجزء يضمن تممد المحتوى ودفع الفوتر للأسفل */
        }
        .navbar {
            background: #0f172a !important;
            padding: 1rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .main-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 2rem;
        }
        .footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 2rem 0;
            margin-top: 3rem;
            flex-shrink: 0;
        }
        .footer a {
            color: #f8fafc;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer a:hover {
            color: #3b82f6;
        }
        .footer-border {
            border-top: 1px solid #1e293b;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }
    </style>
</head>
<body>

<div class="content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
      <div class="container">
        <a class="navbar-brand text-primary" href="/">MY<span class="text-white">APP</span></a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link text-white fw-medium" href="/tasks">Tasks Explorer</a>
        </div>
      </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h5 class="text-white fw-bold mb-1">My Task Manager</h5>
                <p class="small mb-0">Organize your work and life, finally.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <div class="d-flex justify-content-center justify-content-md-end gap-3">
                    <a href="#" class="small">Privacy Policy</a>
                    <a href="#" class="small">Terms of Service</a>
                    <a href="#" class="small">Help Center</a>
                </div>
            </div>
        </div>
        <div class="footer-border text-center">
            <p class="small mb-0">&copy; 2026 My App Inc. Built with Laravel & Mohammed Ibrahim</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>