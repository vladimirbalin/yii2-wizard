<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%extra_item}}`.
 */
class m210223_151501_create_extra_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%extra_item}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notnull(),
            'price' => $this->decimal(10,2)->notnull(),
            'image' => $this->string()->notnull(),
            'description' => $this->text()->notnull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%extra_item}}');
    }
}
