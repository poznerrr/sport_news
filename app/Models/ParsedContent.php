<?php
declare(strict_types=1);

namespace App\Models;

class ParsedContent
{
    private ?string $title = null;

    private ?string $text = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function isValid(): bool
    {
        if (is_null($this->title) || is_null($this->text)) {
            return false;
        }
        return true;
    }

}
