<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ParsedContent;

class ContentParser
{

    public function parseContent(string $content): ParsedContent
    {
        $parsedContent = new ParsedContent();
        $parsedContent->setTitle($this->getTitle($content));
        $parsedContent->setText($this->getMainNews($content));
        return $parsedContent;
    }

    private function getTitle(string $content): ?string
    {
        preg_match_all("/<h1 class='ipsType_pageTitle(.*?)h1>/s", $content, $infoLines);
        $title = $infoLines[0][0] ?? null;
        if (!is_null($title)) {
            preg_match_all("/<div class='ipsType_break ipsContained'>(.*?)<\/div>/s", $title, $infoLines);
            $title = $infoLines[1][0] ?? null;
        }
        return $title;
    }

    private function getMainNews(string $content): ?string
    {
        preg_match_all("/<h1 class='ipsType_pageTitle(.*?)<\/p>\n<div/s", $content, $infoLines);
        $text = $infoLines[0][0] ?? null;
        if (!is_null($text)) {
            preg_match_all("/<p>(.*)<\/p>/s", $text, $infoLines);
            $text = $infoLines[0][0] ?? null;
        }
        return $text;
    }


}
