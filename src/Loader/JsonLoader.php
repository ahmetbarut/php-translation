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
    public object $translations;

    /**
     * directory of files
     *
     * @var string
     */
    public string $path;

    /**
     * Returns the content of the requested file.
     *
     * @param string $file
     * @return bool|JsonLoader
     */
    public function get(string $file): bool|static
    {
        if (!file_exists($this->path . '/' . $file . '.json')) {
            return false;
        }
        $this->translations = json_decode(file_get_contents($this->path . '/' . $file . '.json'), null);
        return $this;
    }

    /**
     * Returns the value of the relevant key.
     *
     * @param string $key
     * @return void
     * @throws \Exception
     */
    public function key(string $key)
    {
        $key = explode('.', $key);

        if (count($key) === 1){
            throw new \Exception("This is the array loader, not the Database loader.");
        }

        if($this->get($key[0]) === false) {
            return current($key);
        }

        return $this->translations->{$key[1]};
    }

    /**
     * Resolves the directory where the files are located
     * @param string $path
     * @param string $locale
     * @return static
     */
    public function resolve(mixed $path, string $locale): static
    {
        $this->path = $path . '/' . $locale;
        return $this;
    }
}
