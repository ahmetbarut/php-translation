<?php 

namespace ahmetbarut\Translation\Loader;

interface ILoader
{
    /**
     * Brings the file of the relevant translation.
     *
     * @param string $file
     * @return void
     */
    public function get(string $file);


    /**
     * Returns the value of the requested translation.
     *
     * @param string $key
     * @return string
     */
    public function key(string $key);


    /**
     * Analyzes the requested file to be uploaded
     *
     * @param string $path
     * @param string $file
     * @param string $locale
     * @return object
     */
    public function resolve(mixed $path, string $locale);
}