<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120910233748 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP TABLE ext_log_entries");
        $this->addSql("DROP TABLE ext_translations");
        $this->addSql("ALTER TABLE event__mails DROP FOREIGN KEY FK_DBF9BBCB71F7E88B");
        $this->addSql("ALTER TABLE event__mails ADD CONSTRAINT FK_DBF9BBCB71F7E88B FOREIGN KEY (event_id) REFERENCES event__events (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event__tickets DROP FOREIGN KEY FK_66E295594C3A3BB");
        $this->addSql("ALTER TABLE event__tickets DROP FOREIGN KEY FK_66E2955971F7E88B");
        $this->addSql("ALTER TABLE event__tickets DROP FOREIGN KEY FK_66E29559A76ED395");
        $this->addSql("ALTER TABLE event__tickets ADD CONSTRAINT FK_66E295594C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event__tickets ADD CONSTRAINT FK_66E2955971F7E88B FOREIGN KEY (event_id) REFERENCES event__events (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event__tickets ADD CONSTRAINT FK_66E29559A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE payments DROP FOREIGN KEY FK_65D29B32A76ED395");
        $this->addSql("ALTER TABLE payments ADD CONSTRAINT FK_65D29B32A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(32) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:array)', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, UNIQUE INDEX lookup_unique_idx (locale, object_class, foreign_key, field), INDEX translations_lookup_idx (locale, object_class, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE event__mails DROP FOREIGN KEY FK_DBF9BBCB71F7E88B");
        $this->addSql("ALTER TABLE event__mails ADD CONSTRAINT FK_DBF9BBCB71F7E88B FOREIGN KEY (event_id) REFERENCES event__events (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event__tickets DROP FOREIGN KEY FK_66E2955971F7E88B");
        $this->addSql("ALTER TABLE event__tickets DROP FOREIGN KEY FK_66E29559A76ED395");
        $this->addSql("ALTER TABLE event__tickets DROP FOREIGN KEY FK_66E295594C3A3BB");
        $this->addSql("ALTER TABLE event__tickets ADD CONSTRAINT FK_66E2955971F7E88B FOREIGN KEY (event_id) REFERENCES event__events (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event__tickets ADD CONSTRAINT FK_66E29559A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE event__tickets ADD CONSTRAINT FK_66E295594C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE payments DROP FOREIGN KEY FK_65D29B32A76ED395");
        $this->addSql("ALTER TABLE payments ADD CONSTRAINT FK_65D29B32A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE");
    }
}
