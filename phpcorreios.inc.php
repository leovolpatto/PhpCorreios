<?php

function load($namespace) {
    $file = str_replace('PhpCorreios\\', '', $namespace);
    $namespace = $file;
    
    $file = str_replace('\\', '/', $namespace) . ".php";
    $file2 = __DIR__ . '\\' .str_replace('\\', '/', $namespace) . ".php";
    if (file_exists($file))
    {
        if(!class_exists($namespace))
            require_once $file;
    }
    elseif(file_exists($file2))
    {
        if(!class_exists($namespace))
            require_once $file;
    }
    else{
        //mail('leovolpatto@gmail.com', 'Classe nao encontrada', "Nao foi encontrado: $file   nem   $file2");
        error_log("Nao foi encontrado: $file   nem   $file2" . PHP_EOL . " Current dir: " .  __DIR__);
    }
}

spl_autoload_register(__NAMESPACE__ . '\load');