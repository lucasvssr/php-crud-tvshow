<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    private string $head;
    private string $title;
    private string $body;

    public function __construct(string $title='')
    {
        parent::__construct($title);
        $this->appendCssUrl('/css/style.css');
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width">
                {$this->getHead()}
                <title>{$this->getTitle()}</title>
            </head>
            <body>
            <div class="header"><h1>{$this->getTitle()}</h1></div>
            <div class="content">
                {$this->getBody()}
                </div>
                <div class="footer"><footer id="lastmodified">Dernière modification de cette page le {$this->getLastModification()}</footer></div>
            </body>
        </html>
        HTML;
    }
}
