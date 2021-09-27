<?php


namespace ahmetbarut\Translation\Loader;


class DatabaseLoader implements ILoader
{
    /**
     * Stored results.
     * @var array $results
     */
    private array $results = [];

    /**
     * Stored resolve keys.
     * @var array $resolved
     */
    private array $resolved = [];

    /**
     * Store table name.
     * @var string $table
     */
    private string $table;

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
    public function resolve(mixed $path, string $locale)
    {
        $query = $path->prepare("SELECT key,value FROM {$this->table} where language = :locale");
        $query->bindParam(':locale', $locale, \PDO::PARAM_STR);
        $query->execute();

        $this->results = $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Set table.
     * @param  string  $tableName
     */
    public function table(string $tableName){
        $this->table = $tableName;
    }
}