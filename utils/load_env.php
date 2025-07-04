<?php

// Função basica para orientar a leitura do env, já que não utilizo composer nesse projeto
function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception(".env não encontrado");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; 
        }

        list($name, $value) = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
            putenv("$name=$value");
        }
    }
}
