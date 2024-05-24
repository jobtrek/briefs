<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Briefs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

    @vite('resources/js/app.js')
</head>
<body>
<div id="app">
    <welcome-component :briefs="{{ json_encode($briefs) }}"></welcome-component>
</div>
</body>
</html>
