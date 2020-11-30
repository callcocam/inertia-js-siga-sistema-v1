<?php


namespace App\Helpers;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Load extends Filesystem
{

    protected $dependencies = [];

    public static function make()
    {
        return new static();
    }

    public function generate()
    {
        $this->dependencies = Collection::make(app_path("Routes/"))->flatMap(function ($path)  {
            return $this->glob(sprintf("%s*.php", $path));
        })->filter()->sortBy(function ($file) {
            return $this->getClassName($file);
        })->values()->keyBy(function ($file) {
            return $this->resolveClass($file);
        })->merge($this->dependencies);

        return $this->dependencies;
    }

    /**
     * Get the name of the migration.
     *
     * @param string $path
     * @return string
     */
    public function getClassName($path)
    {
        return str_replace('.php', '', basename($path));
    }

    /**
     * Resolve a migration instance from a file.
     *
     * @param string $file
     * @return object
     */
    public function resolveClass($file)
    {

        $file = str_replace('.php', '', $file);


        $ds = DIRECTORY_SEPARATOR;

        $class = Str::studly(implode("\\", array_slice(explode($ds, $file), env('LOAD_NIVEL_PATH', 6))));

        return $class;
    }
}
