<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-white text-gray-800 dark:text-gray-100">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
        @yield('sidebar')
        <main class="flex-1 p-6">
            @yield('content')  {{-- Main page content --}}
        </main>
    </div>
</body>
</html>