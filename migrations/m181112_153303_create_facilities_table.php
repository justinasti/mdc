<?php

use yii\db\Migration;

/**
 * Handles the creation of table `facilities`.
 */
class m181112_153303_create_facilities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('facilities', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25)->notNull(),
            'description' => $this->string(60)->notNull(),
            'capacity' => $this->integer(8)->notNull(),
            'managed_by' => $this->integer()
        ]);
        $this->createIndex(
            'idx-facilities-managed_by',
            'facilities','managed_by'
        );
        $this->addForeignKey(
            'fk-facilities-user',
            'facilities','managed_by',
            'user', 'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-facilities-user', 'facilities');
        $this->dropIndex('idx-facilities-managed_by','facilities');
        $this->dropTable('facilities');
    }
}
