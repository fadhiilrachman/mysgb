<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySGB - The place for sharing needs</title>
    <meta name="description" content="MySGB">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container">
                    <a class="navbar-brand me-auto" href="/">
                        <img class="logo-mysgb" src="{{ asset('/images/logo/logo.png') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                @auth
                                    <a class="btn btn-outline-primary btn-lg" href="{{ route('login') }}">Go to Dashboard</a>
                                @else
                                    <a class="btn btn-outline-primary btn-lg" href="{{ route('login') }}">Login</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <section class="hero">
                <div class="hero-content">
                    <div class="hero-text text-center">
                        <h1 class="pt-5">MySGB</h1>
                        <p class="fs-5 mt-3">The place for sharing needs.</p>
                    </div>
                    <div class="hero-image d-flex justify-content-center mt-5">
                        <img src="/assets/images/hero.svg" class="col-md-8 col-12 mx-auto" alt="MySGB">
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>