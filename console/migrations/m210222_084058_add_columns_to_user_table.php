<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210222_084058_add_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string(255));
        $this->addColumn('{{%user}}', 'last_name', $this->string(255));
        $this->addColumn('{{%user}}', 'address', $this->string(255));
        $this->addColumn('{{%user}}', 'city', $this->string(255));
        $this->addColumn('{{%user}}', 'phone', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'address');
        $this->dropColumn('{{%user}}', 'city');
        $this->dropColumn('{{%user}}', 'phone');
    }
}
