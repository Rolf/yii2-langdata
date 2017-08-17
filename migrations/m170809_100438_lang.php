<?php

use yii\db\Migration;

class m170809_100438_lang extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'LangData',
                [
                    'id' => $this->primaryKey(),
                    'slug' => $this->string()->unique()->notNull(),
                    'rus' => $this->text(),
                    'eng' => $this->text(),
                ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('lang_data');
    }
}
