<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item}}`.
 */
class m210224_160513_create_order_item_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'extra_item_id' => $this->integer(),
            'table_id' => $this->integer(),
        ]);
    
    
        $this->addForeignKey('{{%fk-order_item-order_id}}', '{{%order_item}}', 'order_id', '{{%order}}', 'id');
        $this->addForeignKey('{{%fk-order_item-extra_item_id}}', '{{%order_item}}', 'extra_item_id', '{{%extra_item}}', 'id');
        $this->addForeignKey('{{%fk-order_item-table_id}}', '{{%order_item}}', 'table_id', '{{%table}}', 'id');
    }
    
    
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-order_item-table_id}}', '{{%order_item}}');
        $this->dropForeignKey('{{%fk-order_item-extra_item_id}}', '{{%order_item}}');
        $this->dropForeignKey('{{%fk-order_item-order_id}}', '{{%order_item}}');
    
    
        $this->dropTable('{{%order_item}}');
    }
}
