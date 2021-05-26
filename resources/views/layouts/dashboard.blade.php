<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>
    <header class="py-2 bg-dark text-white mb-4">
        <div class="container">
            <h1 class="h3">{{ config('app.name') }}</h1>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <h4>Navigation Menu</h4>
                <nav>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Categories</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Products</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="col-md-9">
                <div class="mb-4">
                    <h3 class="text-primary">@yield('title', 'Default Title')</h3>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>