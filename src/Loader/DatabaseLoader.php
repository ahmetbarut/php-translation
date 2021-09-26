<?php


namespace ahmetbarut\Translation\Loader;


class DatabaseLoader implements ILoader
{
    private array $results = [];

    private array $resolved = [];
    /**
     * @inheritDoc
     */
    public function get(string $file)
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function key(string $key)
    {
        foreach ($this->results as $result) {
            $this->resolved[$result["key"]] = $result["value"];
        }
        return $this->resolved[$key];
    }

    /**
     * @inheritDoc
     */
    public function resolve(string $path, string $locale)
    {
        $query = $path->prepare("SELECT key,value FROM langs where language = :locale");
        $query->bindParam(':locale', $locale, \PDO::PARAM_STR);
        $query->execute();
        $this->results = $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}