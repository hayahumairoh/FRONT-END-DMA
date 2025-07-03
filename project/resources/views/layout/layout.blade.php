<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Sidebar Menu</title>

    <link rel="stylesheet" href="{{url('style.css')}}">
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="brand-link active">
                <div class="logo-placeholder"></div>
                <span class="app-name">[App Name]</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="/" class="active">
                        <span class="nav-icon"></span>
                        <span>Main Menu</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="nav-icon"></span>
                        <span>New Request</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="nav-icon"></span>
                        <span>Request Assessment</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>