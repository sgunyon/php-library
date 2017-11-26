<?php

// register autoload() method of the Autoloader class
spl_autoload_register('Autoloader::autoload');

class Autoloader {

    //autoload specified file
    public static function autoload($class) {
        //split the class name by the underscore.
        $pathes = explode('_', $class);
        
        //determine the current path
        $path = getcwd();
        
        //if the class name contains an underscore, the firt part is the folder name inside the views folder
        if(count($pathes) > 1) {
            $path = $path . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . strtolower($pathes[0]);
            $class = $pathes[1];
        }
        
        $file = $path . DIRECTORY_SEPARATOR . self::camelCaseToUnderscore($class) . '.class.php';

        if (is_readable($file)) {
            require_once($file);
        } else {
            self::recursive_autoload($class, $path);
        }
    }

    // try to load recursively the specified file
    private static function recursive_autoload($class, $path) {
        if (FALSE !== ($handle = opendir($path))) {
            while (FAlSE !== ($dir = readdir($handle))) {
                if (strpos($dir, '.') === FALSE) {
                    $path2 = $path . '/' . $dir;
                    $filepath = $path2 . '/' . self::camelCaseToUnderscore($class) . '.class.php';
                    if (is_readable($filepath)) {
                        require_once($filepath);
                        break;
                    }
                    self::recursive_autoload($class, $path2);
                }
            } closedir($handle);
        }
    }

    /*
     * Convert a camel case string to underscores (eg: camelCase becomes camel_case)
     */

    private static function camelCaseToUnderscore($str) {
        //store all characters in an array
        $characters = str_split($str);

        //lowercase the first character
        $characters[0] = strtolower($characters[0]);

        //exam all characters in the array
        //if a character is uppercase, replace it with a lowercase and prefix it with an underscore
        foreach ($characters as &$character) {
            if (ord($character) >= ord('A') && ord($character) <= ord('Z'))
                $character = '_' . strtolower($character);
        }

        //conver all elements in the array into a string and return the string
        return implode('', $characters);
    }

}