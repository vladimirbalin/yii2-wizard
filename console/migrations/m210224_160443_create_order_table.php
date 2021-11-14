<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m210224_160443_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull(),
            'event_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'event_date' => $this->date()->notNull(),
            'transaction_id' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);
    
    
        $this->addForeignKey('{{%fk-order-event_id}}', '{{%order}}', 'event_id', '{{%event}}', 'id');
        $this->addForeignKey('{{%fk-order-customer_id}}', '{{%order}}', 'customer_id', '{{%user}}', 'id');
    }
    
    
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-order-customer_id}}', '{{%order}}');
        $this->dropForeignKey('{{%fk-order-event_id}}', '{{%order}}');
    
    
        $this->dropTable('{{%order}}');
    }
}
