<?php

use yii\db\Migration;

/**
 * Class m200909_044507_archive
 */
class m200909_044507_archive extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS {{%categories}} (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
   `parent_id` INT NULL,
  `status` INT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB");

        $this->execute("CREATE TABLE IF NOT EXISTS {{%folders}} (
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NULL,
            `type` INT NULL DEFAULT 1 COMMENT '1-open folder, 2-secret folder',
            `status` INT NULL DEFAULT 1 COMMENT '1-active, 2-inactive, 3-deleted',
            `parent_id` INT NULL,
            `created_at` INT NULL,
            `updated_at` INT NULL,
                PRIMARY KEY (`id`))
            ENGINE = InnoDB");


        $this->execute("CREATE TABLE IF NOT EXISTS {{%files}} (
  `id` INT NOT NULL AUTO_INCREMENT,
  `folder_id` INT NULL,
  `category_id` INT NULL,
  `type_id` INT NULL,
  `view_count` INT NULL DEFAULT 0,
  `download_count` INT NULL DEFAULT 0,
  `title` VARCHAR(255) NULL,
  `file_cover` VARCHAR(255) NULL COMMENT 'Обложка файла',
  `document_number` VARCHAR(255) NULL,
  `document_date` INT NULL,
  `document_description` TEXT NULL,
  `document_author` VARCHAR(255) NULL,
  `file_name` VARCHAR(255) NULL,
  `file_size` VARCHAR(45) NULL,
  `file_extension` VARCHAR(45) NULL,
  `file_path` VARCHAR(255) NULL,
  `file_page_count` INT NULL,
  `created_at` INT NULL,
  `updated_at` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categories_idx` (`category_id`),
  INDEX `fk_folders_idx` (`folder_id`),
  CONSTRAINT `fk_categories`
    FOREIGN KEY (`category_id`)
    REFERENCES `categories` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_folders`
    FOREIGN KEY (`folder_id`)
    REFERENCES `folders` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB");


        $this->execute("CREATE TABLE IF NOT EXISTS {{%languages}} (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB");

        $this->execute("CREATE TABLE IF NOT EXISTS {{%file_language}} (
  `file_id` INT NULL,
  `language_id` INT NULL,
  INDEX `fk_files_idx` (`file_id`),
  INDEX `fk_languages_idx` (`language_id`),
  CONSTRAINT `fk_files`
    FOREIGN KEY (`file_id`)
    REFERENCES `files` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_languages`
    FOREIGN KEY (`language_id`)
    REFERENCES `languages` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB");


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200909_044507_archive cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200909_044507_archive cannot be reverted.\n";

        return false;
    }
    */
}

