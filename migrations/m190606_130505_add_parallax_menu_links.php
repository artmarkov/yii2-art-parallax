<?php

use yii\db\Migration;

class m190606_130505_add_parallax_menu_links extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'parallax', 'menu_id' => 'admin-menu', 'link' => '/parallax/default/index', 'created_by' => 1, 'order' => 1]);        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'parallax', 'label' => 'Parallax', 'language' => 'en-US']);
        
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'parallax']);
    }
}