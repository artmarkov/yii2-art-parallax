<?php

use yii\db\Migration;

class m190606_125959_create_parallax_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
             $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parallax}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string()->notNull(),
            'bg_color' => $this->string(),
            'bg_image' => $this->string()->notNull(),
            'parallax_class' => $this->string(),
            'background_ratio' => $this->string(),
            'content_image' => $this->string(),
            'content' => $this->text()->notNull(),
            'countdown' => $this->tinyInteger()->notNull()->defaultValue('0')->comment('Включить счетчик'),
            'countdown_prompt' => $this->string()->notNull(),
            'start_timestamp' => $this->integer(),
            'url' => $this->string()->notNull(),
            'btn_icon' => $this->string()->notNull(),
            'btn_name' => $this->string()->notNull(),
            'btn_class' => $this->string()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('created_by', '{{%parallax}}', 'created_by');
        $this->createIndex('updated_by', '{{%parallax}}', 'updated_by');
        $this->addForeignKey('parallax_ibfk_1', '{{%parallax}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('parallax_ibfk_2', '{{%parallax}}', 'updated_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }
    
    public function down()
    {
       $this->dropTable('{{%parallax}}');
    }
}
