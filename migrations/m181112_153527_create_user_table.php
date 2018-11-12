<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181112_153527_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(75)->notNull(),
            'username' => $this->string(20)->notNull(),
            'email' => $this->string(25)->notNull(),
            'password' => $this->string(18)->notNull(),
            'mobile_number' => $this->string(11)->notNull(),
            'role' => $this->integer(3)->notNull(),
            'authKey' => $this->string(191)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
