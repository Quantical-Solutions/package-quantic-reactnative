<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', app()->getLocale()) ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
    <meta name="referrer" content="origin-when-cross-origin">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title><?= config('app.name') ?> App</title>
    <?php if (strlen($headLibs) > 0) { ?>
    <!-- Compiled Librairies -->
    <script type="text/javascript">
        <?= $headLibs . "\n" ?>
    </script>
    <?php } ?>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <?php if (strlen($headStyles) > 0) { ?>
    <!-- Compiled Styles -->
    <style>
        <?= $headStyles . "\n" ?>
    </style>
    <?php } ?>
</head>
<body class="font-sans antialiased">
