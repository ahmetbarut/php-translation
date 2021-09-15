<?php

namespace ahmetbarut\Translation\Loader;

use ahmetbarut\Translation\Loader\ILoader;

class JsonLoader implements ILoader
{
    /**
     * Returns the specified page in an array.
     *
     * @var object
     */
    public $translations;

    /**
     * directory of files
     *
     * @var string
     */
    public $path;

    /**
     * Returns the content of the requested file.
     *
     * @param string $file
     * @return void
     */
    public function getFile($file)
    {
        if (!file_exists($this->path . '/' . $file . '.json')) {
            return false;
        }
        $this->translations = json_decode(file_get_contents($this->path . '/' . $file . '.json'), null);
    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $key
     * @return void
     */
    public function key($key)
    {
        $key = explode('.', $key);
        if($this->getFile($key[0]) === false) {
            return false;
        }
        
        return $this->translations->{$key[1]};
    }

    /**
     * Resolves the directory where the files are located
     * @param string $path
     * @param string $locale
     * @return void
     */
    public function resolveFile($path, $locale)
    {
        $this->path = $path . '/' . $locale;
        return $this;
    }
}
