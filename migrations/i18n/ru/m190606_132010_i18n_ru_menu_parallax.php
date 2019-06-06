<?php

use yii\db\Migration;

class m190606_132010_i18n_ru_menu_parallax extends Migration
{

    public function up()
    {
        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'parallax', 'label' => 'Параллакс', 'language' => 'ru']);

    }

}