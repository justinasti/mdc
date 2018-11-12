<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reservations`.
 */
class m181112_153401_create_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reservations', [
            'id' => $this->primaryKey(),
            'occasion' => $this->string(25)->notNull(),
            'no_of_participants' => $this->integer(8)->notNull(),
            'datetime_start' => $this->dateTime()->notNull(),
            'datetime_end' => $this->dateTime()->notNull(),
            'facility_id' => $this->integer(),
            'userid' => $this->integer(),
            'reservedatetime' => $this->dateTime()->notNull(),
            'status' => $this->integer(1)->notNull(),
            'confirmation_level' => $this->integer(1)->notNull()
        ]);
        $this->createIndex(
            'idx-reservations-facility_id',
            'reservations','facility_id'
        );
        $this->addForeignKey(
            'fk-reservations-facilities',
            'reservations','facility_id',
            'facilities', 'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reservations-userid',
            'reservations','userid'
        );
    
        $this->addForeignKey(
            'fk-reservations-user',
            'reservations','userid',
            'user', 'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-reservations-facilities', 'reservations');
        $this->dropIndex('idx-reservations-facility_id','reservations');
        $this->dropForeignKey('fk-reservations-user', 'reservations');
        $this->dropIndex('idx-reservations-userid','reservations');
        $this->dropTable('reservations');
    }
}
