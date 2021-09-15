<?php 

namespace ahmetbarut\Translation;

class Translation 
{
    protected $path;
    
    protected $format;

    protected static $loader;
    
    protected static $locale = "en";
    
    /**
     * Undocumented function
     *
     * @param string $path dil dosyalarının bulunduğu dizini belirtir
     * @param string $format Hangi dosya tipinin kullanılacağını belirtir.
     */
    public function __construct($path, $format = "array")
    {
        $this->path = $path;

        $this->format = $format;

        $class = include __DIR__.'/config.php';

        static::$loader = new $class[$format]['class'];

        static::$loader->resolveFile($path, static::$locale);
    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $key
     * @return string
     */
    public static function get($key)
    {
        return static::$loader->key($key);
    }

    /**
     * Selects local.
     *
     * @param string $locale
     * @return void
     */
    public function setLocale($locale)
    {
        static::$loader->resolveFile($this->path, $locale);

        static::$locale = $locale;
    }
    
}