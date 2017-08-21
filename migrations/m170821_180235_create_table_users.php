<?php

use yii\db\Migration;

class m170821_180235_create_table_users extends Migration
{
    const API_TABLE_NAME = '{{%users}}';

    public function up()
    {
        $this->createTable($this::API_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
    }
    public function down()
    {
        $this->dropTable($this::API_TABLE_NAME);
    }
}
