<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reserve_equipments`.
 */
class m181112_153435_create_reserve_equipments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reserve_equipments', [
            'id' => $this->primaryKey(),
            'reservation_id' =>$this->integer(),
            'equipment_id' => $this->integer(),
            'quantity' => $this->integer(5)->notNull()
        ]);
        $this->createIndex(
            'idx-reserve_equipments-reservation_id',
            'reserve_equipments','reservation_id'
        );
        $this->addForeignKey(
            'fk-reserve_equipments-reservations',
            'reserve_equipments','reservation_id',
            'reservations', 'id',
            'SET NULL'
        );
        $this->createIndex(
            'idx-reserve_equipments-equipment_id',
            'reserve_equipments','equipment_id'
        );
    
        $this->addForeignKey(
            'fk-reserve_equipments-equipments',
            'reserve_equipments','equipment_id',
            'equipments', 'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-reserve_equipments-reservations', 'reserve_equipments');
        $this->dropIndex('idx-reserve_equipments-reservation_id','reserve_equipments');
        $this->dropForeignKey('fk-reserve_equipments-equipments', 'reserve_equipments');
        $this->dropIndex('idx-reserve_equipments-equipment_id','reserve_equipments');
        $this->dropTable('reserve_equipments');
    }
}
