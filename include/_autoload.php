<?php
spl_autoload_register(
    function ($className) {
        $class = PATH . 'class/' . $className . '.php';
        if (file_exists($class)) {
            require_once $class;
        } else {
            mail('loic.barbado@orange.fr', 'bad class loading', $class);
            throw new Exception('classe ' . $className . '.php inexistante : ' . $class);
        }
    }
);
