<?php

use yii\db\Migration;

/**
 * Handles adding others to table `user`.
 */
class m180804_093530_add_others_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'nom', $this->string()->notNull().' AFTER `username`');
        $this->addColumn('{{%user}}', 'prenom', $this->string()->notNull().' AFTER `nom`');
        $this->addColumn('{{%user}}', 'telephone', $this->string()->notNull()->unique().' AFTER `prenom`');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'nom');
        $this->dropColumn('{{%user}}', 'prenom');
        $this->dropColumn('{{%user}}', 'telephone');
    }
}
