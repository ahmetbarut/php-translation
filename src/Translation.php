<?php 

namespace ahmetbarut\Translation;

class Translation 
{
    protected null|\PDO|string $path;
    
    protected string $format;

    protected static $loader;
    
    protected static string $locale = "en";
    
    /**
     * Undocumented function
     *
     * @param string $path dil dosyalarının bulunduğu dizini belirtir
     * @param string $format Hangi dosya tipinin kullanılacağını belirtir.
     */
    public function __construct(string $path, string $format = "array", ?\PDO $connect = null)
    {
        $this->path = $path;

        $this->format = $format;

        $class = include __DIR__.'/config.php';

        static::$loader = new $class[$format]['class'];

        static::$loader->resolve($path, static::$locale);
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