<?php
$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->overload();

try {
    $dotenv->required([
        'COOKIES_KEY', 'DB_DSN', 'DB_USERNAME'
    ])->notEmpty();

    // É obrigatória, mas pode estar vazia: ""
    $dotenv->required([
        'DB_PASSWORD',
    ]);

    $dotenv->required('ENVIRONMENT')->allowedValues(['development', 'test', 'production']);

} catch (Exception $e) {
    echo "Verifique o arquivo \".env\":\n";
    echo $e->getMessage(), "\n";
    exit(1);
}
