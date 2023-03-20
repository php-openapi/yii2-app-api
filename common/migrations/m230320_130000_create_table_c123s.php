<?php

/**
 * Table for C123
 */
class m230320_130000_create_table_c123s extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%c123s}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->null()->defaultValue(null),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%c123s}}');
    }
}
