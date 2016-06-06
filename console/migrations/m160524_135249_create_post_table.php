<?php

use yii\db\Migration;

/**
 * Handles the creation for table `post_table`.
 */
class m160524_135249_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%post}}', array(
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'image_id' => $this->integer(),
            'title' => $this->string(45),
            'text' => $this->string(255),
            'begin' => $this->integer(),
            'end' => $this->integer(),
            'cost' => $this->decimal(10,2),
            'status' => $this->boolean(),

            'updated_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
        ), $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
