<?php

use yii\db\Migration;

/**
 * Handles the creation of table `equipments`.
 */
class m181112_152126_create_equipments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('equipments', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25)->notNull(),
            'description' => $this->string(60)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('equipments');
    }
}
