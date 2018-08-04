<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m180804_095715_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'montant' => $this->integer()->notNull(),
            'date' => $this->datetime()->notNull(),
            'type_id' => $this->integer(),
            'budget_id' => $this->integer(),
        ],$tableOptions);


        $this->createIndex(
            'idx-transaction-type_id',
            '{{%transaction}}',
            'type_id'
        );        

        $this->createIndex(
            'idx-transaction-budget_id',
            '{{%transaction}}',
            'budget_id'
        );

        $this->addForeignKey(
            'fk-transaction-type_id',
            '{{%transaction}}',
            'type_id',
            '{{%type}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-transaction-budget_id',
            '{{%transaction}}',
            'budget_id',
            '{{%budget}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-transaction-type_id',
            '{{%transaction}}'
        );

        $this->dropIndex(
            'idx-transaction-type_id',
            '{{%transaction}}'
        );


        $this->dropForeignKey(
            'fk-transaction-budget_id',
            '{{%transaction}}'
        );

        $this->dropIndex(
            'idx-transaction-budget_id',
            '{{%transaction}}'
        );

        $this->dropTable('{{%transaction}}');
    }
}
