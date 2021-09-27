<?php

namespace ahmetbarut\Translation\Loader;


use Exception;

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
    public string $path;

    /**
     * Returns the content of the requested file.
     *
     * @param  mixed  $path
     * @param  string  $locale
     *
     * @return ArrayLoader
     */
    public function resolve(mixed $path, string $locale): static
    {
        $this->path = $path . '/' . $locale;
        return $this;
    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $file
     *
     * @return false
     */
    public function get(string $file): false| ArrayLoader
    {
        if (!file_exists($this->path . '/' . $file . '.php')) {
            return false;
        }
        $this->translations = include $this->path . '/' . $file . '.php';
        return $this;
    }

    /**
     * Resolves the directory where the files are located
     *
     * @param  string  $key
     * @throws Exception
     * @return void
     */
    public function key(string $key)
    {
        $key = explode('.', $key);

        if (count($key) === 1){
            throw new Exception("This is the array loader, not the Database loader.");
        }

        if ($this->get($key[0]) === false) {
            return current($key);
        }
        return $this->translations[$key[1]];
    }
}
