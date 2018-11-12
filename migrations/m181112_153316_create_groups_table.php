<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m181112_153316_create_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('groups', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25)->notNull(),
            'description' => $this->string(60)->notNull(),
            'adviser_id' => $this->integer()
        ]);
        $this->createIndex(
            'idx-groups-adviser_id',
            'groups','adviser_id'
        );
        $this->addForeignKey(
            'fk-groups-user',
            'groups','adviser_id',
            'user', 'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-groups-user', 'groups');
        $this->dropIndex('idx-groups-adviser_id','groups');
        $this->dropTable('groups');
    }
}
