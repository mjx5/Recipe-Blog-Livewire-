<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #140127; /* Dark blue color */
            margin: 0; /* Remove default margin */
        }
        header {
            margin-bottom: 0; /* Remove space below the header */
        }
        main {
            margin-top: 0; /* Remove space above the main content */
        }
    </style>

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
