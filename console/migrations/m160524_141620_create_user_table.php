<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_table`.
 */
class m160524_141620_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */

    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45)->unique(),
            'fullname' => $this->string(45),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(255),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255)->unique(),
            'status' => $this->boolean(),

            'updated_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
