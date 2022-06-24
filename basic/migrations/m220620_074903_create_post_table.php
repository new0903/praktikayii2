<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m220620_074903_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200),
            'phone' => $this->string(200),
            'email' => $this->string(200),
            'file' => $this->string(200)->null(),
            'text' => $this->text(),
            'data' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
