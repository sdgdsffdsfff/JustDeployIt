<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1' name='viewport'>
    <title>treetree - Deploy</title>
    <link href="/css/cloud.typography.com/fonts.css" media="screen" rel="stylesheet" />
    <link href="/css/application-c2577e410b34fa9f4ea1e85a71113b0f.css" media="screen" rel="stylesheet" />
</head>
<body class='session-page'>
<div class='session-header'>
    <div class='session-container'>
        <h1><a href="/login"><img alt="Logo" src="/img/logo-acf8a53bc09be8200bbb1bf638bc7c00.svg" /></a></h1>
    </div>
</div>
<div class='session-container'>
<?php
echo $this->Session->flash();
echo $this->Session->flash('auth');
echo $this->fetch('content');
?>

</div>
</body>
</html>
