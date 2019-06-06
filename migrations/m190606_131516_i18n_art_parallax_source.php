<?php

use artsoft\db\SourceMessagesMigration;

class m190606_131516_i18n_art_parallax_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'art/parallax';
    }

    public function getMessages()
    {
        return [
            'Bg Color' => 1,            
            'Bg Image' => 1,
            'Btn Icon' => 1,
            'Btn Class' => 1,
            'Btn Name' => 1,
            'Content Image' => 1,
            'Countdown' => 1,
            'Countdown Prompt' => 1,
            'Parallaxes' => 1,
            'Parallax Class' => 1,
            'Background Ratio' => 1,
            'Start Time' => 1,
            'Url' => 1,
        ];
    }
}