<?php

declare(strict_types=1);

namespace Html;

use DateTime;
use IntlDateFormatter;

class WebPage
{
    private string $head;
    private string $title;
    private string $body;

    public function __construct(string $title='')
    {
        $this->title = $title;
        $this->head = '';
        $this->body = '';
    }


    public function getHead(): string
    {
        return $this->head;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    public function appendCss(string $css): void
    {
        $this->head .= "\n        <style>\n  {$css}\n        </style>\n";
    }

    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link href='{$url}' rel='stylesheet'>";
    }

    public function appendJs(string $js): void
    {
        $this->head .= "\n        <script>\n   ".$js."\n        </script>";
    }

    public function appendJsUrl(string $url): void
    {
        $this->head .= "\n        <script src='{$url}'></script>";
    }

    public function appendContent(string $content): void
    {
        $this->body .= "\n        {$content}";
    }

    public function toHTML(): string
    {
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width">
                {$this->getHead()}
                <title>{$this->getTitle()}</title>
            </head>
            <body>
                {$this->getBody()}
                <footer id="lastmodified">Dernière modification de cette page le {$this->getLastModification()}</footer>
            </body>
        </html>
        HTML;
        return $html;
    }

    public function getLastModification(): string
    {
        $date = new DateTime();
        $date->setTimestamp(filemtime(basename($_SERVER['SCRIPT_NAME'])));
        return IntlDateFormatter::formatObject($date, "dd/MM/YYYY HH:mm:ss");
    }

    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES |ENT_HTML5);
    }
}
