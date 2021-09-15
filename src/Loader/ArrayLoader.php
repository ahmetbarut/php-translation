<?php

namespace ahmetbarut\Translation\Loader;


class ArrayLoader implements ILoader
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
    public function resolveFile($path, $locale)
    {
        $this->path = $path . '/' . $locale;
        return $this;
    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $key
     * @return void
     */
    public function getFile($file)
    {
        if (!file_exists($this->path . '/' . $file . '.php')) {
            return false;
        }
        $this->translations = include $this->path . '/' . $file . '.php';
    }

    /**
     * Resolves the directory where the files are located
     * @param string $path
     * @param string $locale
     * @return void
     */
    public function key($key)
    {
        $key = explode('.', $key);
        if ($this->getFile($key[0]) === false) {
            return $key;
        }
        return $this->translations[$key[1]];
    }
}
