<?php
declare(strict_types=1);

namespace App\Services;

class ContentGetter
{
    private int $iterator;
    /**
     * @var false|resource
     */
    private $handle;


    public function __construct(string $path)
    {
        $this->handle = fopen($path, "r");
    }

    public function __destruct()
    {
        fclose($this->handle);
    }

    public function isValid(): bool
    {
        if ($this->handle === false) {
            return false;
        }
        return true;
    }

    public function getContents(): \Generator
    {
        while (($data = fgetcsv($this->handle)) !== false) {
            $content = file_get_contents($data[0]);
            yield $content;
        }
    }

}
