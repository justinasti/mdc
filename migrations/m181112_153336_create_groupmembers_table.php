<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groupmembers`.
 */
class m181112_153336_create_groupmembers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('groupmembers', [
            'id' => $this->primaryKey(),
            'userid' => $this->integer(),
            'groupid' => $this->integer(),
            'grouprole' => $this->integer(1)
        ]);
        $this->createIndex(
            'idx-groupmembers-userid',
            'groupmembers','userid'
        );
        $this->addForeignKey(
            'fk-groupmembers-user',
            'groupmembers','userid',
            'user', 'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-groupmembers-groupid',
            'groupmembers','groupid'
        );
    
        $this->addForeignKey(
            'fk-groupmembers-groups',
            'groupmembers','groupid',
            'groups', 'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-groupmembers-user', 'groupmembers');
        $this->dropIndex('idx-groupmembers-userid','groupmembers');
        $this->dropForeignKey('fk-groupmembers-groups', 'groupmembers');
        $this->dropIndex('idx-groupmembers-groupid','groupmembers');
        $this->dropTable('groupmembers');
    }
}
