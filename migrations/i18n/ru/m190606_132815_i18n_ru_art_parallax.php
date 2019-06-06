<?php

use artsoft\db\TranslatedMessagesMigration;

class m190606_132815_i18n_ru_art_parallax extends TranslatedMessagesMigration
{

    public function getLanguage()
    {
        return 'ru';
    }

    public function getCategory()
    {
        return 'art/parallax';
    }

    public function getTranslations()
    {
        return [
            'Bg Color' => 'Фон',            
            'Bg Image' => 'Фон.изображение',
            'Btn Icon' => 'Иконка кнопки',
            'Btn Class' => 'Класс кнопки',
            'Btn Name' => 'Название кнопки',
            'Content Image' => 'Изображение контента',
            'Countdown' => 'Обратный отчет',
            'Countdown Prompt' => 'Сообщение счетчика',
            'Parallaxes' => 'Параллаксы',
            'Parallax Class' => 'Класс параллакса',
            'Background Ratio' => 'Разрешение фона',
            'Start Time' => 'Старт события',
            'Url' => 'Url кнопки',
        ];
        
    }
}