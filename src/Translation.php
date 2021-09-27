<?php 

namespace ahmetbarut\Translation;

use ahmetbarut\Translation\Loader\ILoader;
use PDO;

class Translation
{
    /**
     * Store directory or database connection.
     * @var PDO|string|null
     */
    protected null|PDO|string $path;

    /**
     * Store format type.
     * @var string
     */
    protected string $format;

    /**
     * Store loader.
     * @var ILoader
     */
    protected static ILoader $loader;

    /**
     * Store locale.
     * @var string
     */
    protected static string $locale = "en";
    
    /**
     * Translation constructor
     *
     * @param string $path specifies the directory where the language files are located
     * @param string $format Specifies which file type to use.
     */
    public function __construct(string $path = "", string $format = "array", ?PDO $connect = null, string $table = "translation")
    {
        $this->format = $format;

        $class = include __DIR__.'/config.php';

        static::$loader = new $class[$format]['class'];

        $this->path = ($format === 'db') ? $connect : $path;

        if ($format === 'db') {
            static::$loader->table($table);
        }

    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $key
     * @return string
     */
    public static function get(string $key): string
    {
        return static::$loader->key($key);
    }

    /**
     * Selects local.
     *
     * @param string $locale
     * @return void
     */
    public function setLocale(string $locale)
    {
        static::$loader->resolve($this->path, $locale);

        static::$locale = $locale;
    }
    
}