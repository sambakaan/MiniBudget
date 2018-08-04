<?php

use yii\db\Migration;

/**
 * Handles the creation of table `budget`.
 */
class m180804_094143_create_budget_table extends Migration
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

        $this->createTable('{{%budget}}', [
            'id' => $this->primaryKey(),
            'somme' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'date_ajout' => $this->datetime()->notNull(),
        ],$tableOptions);


        $this->createIndex(
            'idx-budget-user_id',
            '{{%budget}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk-budget-user_id',
            '{{%budget}}',
            'user_id',
            '{{%user}}',
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
            'fk-budget-user_id',
            '{{%budget}}'
        );

        $this->dropIndex(
            'idx-budget-user_id',
            '{{%budget}}'
        );
        
        $this->dropTable('{{%budget}}');
    }
}
