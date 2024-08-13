<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <header>
        <!-- Your navigation code here -->
        @include('components.header')
    </header>

    <main >
        {{ $slot }}
        
    </main>


<footer class="dark:bg-gray-800">
    @include('components.footer')
</footer>

</body>
</html>
