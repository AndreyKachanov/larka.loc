<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="content" data-page-name="{{ $pageName }}">
        <p>Here's why you should sign up for our арр: <strong>It's Great.</strong></p>
        @includeFirst('layouts.sign-up-button', ['text' => 'See just how great it is', 'pageName1' => $pageName])
    </div>

    <a href="#" class="button button--callout" data-page-name="{{ $pageName }}">
        <i class="exclamation-icon"></i> {{ $text }}
    </a>
</body>
</html>
