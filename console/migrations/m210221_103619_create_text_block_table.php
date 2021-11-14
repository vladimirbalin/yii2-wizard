<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text_block}}`.
 */
class m210221_103619_create_text_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%text_block}}', [
            'shortcut' => $this->string()->unique(),
            'text' => $this->text(),
        ]);
        $this->addPrimaryKey('{{%pk-text_block-shortcut}}', '{{%text_block}}', 'shortcut');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('{{%pk-text_block-shortcut}}', '{{%text_block}}');
        $this->dropTable('{{%text_block}}');
    }
}
