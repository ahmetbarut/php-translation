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
    public function resolve(mixed $path, string $locale)
    {
        $this->path = $path . '/' . $locale;
        return $this;
    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $file
     * @return false
     */
    public function get(string $file)
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
     * @throws \Exception
     */
    public function key(string $key)
    {
        $key = explode('.', $key);

        if (count($key) === 1){
            throw new \Exception("This is the array loader, not the Database loader.");
        }

        if ($this->get($key[0]) === false) {
            return current($key);
        }
        return $this->translations[$key[1]];
    }
}
