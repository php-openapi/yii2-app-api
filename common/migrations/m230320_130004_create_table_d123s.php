<?php

/**
 * Table for D123
 */
class m230320_130004_create_table_d123s extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%d123s}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->null()->defaultValue(null),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%d123s}}');
    }
}
