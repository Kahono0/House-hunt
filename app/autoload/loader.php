<?php
namespace app\autoload;


class Loader
{
    public static function register()
    {
        
        spl_autoload_register(function ($class) {
          //$dir = "/storage/emulated/0/SERVER/";
            //echo $class."\n";
            $dir = "/storage/emulated/0/house-hunt/";
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            $path = $dir.$file;
            if (file_exists($path)) {
                require $path;
                return true;
            }
            echo "not found ".$path;
            return false;
        });
    }
}
?>