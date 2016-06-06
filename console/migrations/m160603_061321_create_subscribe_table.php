<?php

use yii\db\Migration;

/**
 * Handles the creation for table `subscribe_table`.
 */
class m160603_061321_create_subscribe_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('subscribe', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45),
            'email' => $this->string(255)->unique(),
            'status' => $this->boolean(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscribe');
    }
}
