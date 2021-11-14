<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%table}}`.
 */
class m210224_124230_create_table_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%table}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string(),
            'price' => $this->decimal(10,2)->notNull(),
            'is_custom' => $this->boolean()->notNull()->defaultValue(false),
        ]);
        $this->batchInsert('{{%table}}',['id', 'title', 'subtitle', 'price', 'is_custom'],
        [
            [1, '2', 'People', 200, false],
            [2, '4-6', 'People', 300, false],
            [3, '8-10', 'People', 400, false],
            [4, '12', 'People', 500, false],
            [5, '12+', 'People', 0, true],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%table}}');
    }
}
