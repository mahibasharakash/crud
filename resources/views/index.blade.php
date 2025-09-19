<!doctype html>

<html lang="en">

    <head>

        <!-- Character Encoding -->
        <meta charset="UTF-8"> <!-- Defines the character set for the document -->

        <!-- Viewport Settings for Responsive Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <!-- Ensures the page scales correctly on mobile devices -->

        <!-- IE Compatibility -->
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Tells IE to use the latest rendering engine -->

        <!-- SEO Meta Tags -->
        <meta name="description" content="A CRUD application built with modern web technologies. Create, read, update, and delete data easily.">
        <meta name="keywords" content="CRUD, Web App, JavaScript, Laravel, Vue, Tailwind CSS, Fullstack Development">
        <meta name="author" content="Your Name or Company Name">

        <!-- Social Media / Open Graph Meta Tags -->
        <meta property="og:title" content="CRUD Application">
        <meta property="og:description" content="A simple and efficient CRUD application built with modern web technologies.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://yourwebsite.com">
        <meta property="og:image" content="https://yourwebsite.com/og-image.png">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="CRUD Application">
        <meta name="twitter:description" content="A simple and efficient CRUD application built with modern web technologies.">
        <meta name="twitter:image" content="https://yourwebsite.com/twitter-image.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

        <!-- Title -->
        <title> CRUD Application </title>

        <!-- Vite Assets -->
        @vite(['resources/css/app.css','resources/js/app/app.js'])

    </head>

    <body class="bg-gray-100" id="app"></body>

</html>
