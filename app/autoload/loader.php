<?php
namespace app\autoload;


class loader
{
    public static function register()
    {

        spl_autoload_register(function ($class) {
          //$dir = "/storage/emulated/0/SERVER/";
            //echo $class."\n";
            $dir = "/home/moringa/Documents/otherstuff/House-hunt/";
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            $path = $dir.$file;
            echo $path."\n";
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
