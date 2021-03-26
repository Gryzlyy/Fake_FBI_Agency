<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319095849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admins (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agents (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birth_date VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts_missions (contacts_id INT NOT NULL, missions_id INT NOT NULL, INDEX IDX_21A1513B719FB48E (contacts_id), INDEX IDX_21A1513B17C042CF (missions_id), PRIMARY KEY(contacts_id, missions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hideouts (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions (id INT AUTO_INCREMENT NOT NULL, skills_id INT NOT NULL, hideouts_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, start_date VARCHAR(255) NOT NULL, end_date VARCHAR(255) NOT NULL, INDEX IDX_34F1D47E7FF61858 (skills_id), INDEX IDX_34F1D47EFF2F627D (hideouts_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_agents (missions_id INT NOT NULL, agents_id INT NOT NULL, INDEX IDX_5340AFB917C042CF (missions_id), INDEX IDX_5340AFB9709770DC (agents_id), PRIMARY KEY(missions_id, agents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_targets (missions_id INT NOT NULL, targets_id INT NOT NULL, INDEX IDX_B7328F6017C042CF (missions_id), INDEX IDX_B7328F6043B5F743 (targets_id), PRIMARY KEY(missions_id, targets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills_agents (skills_id INT NOT NULL, agents_id INT NOT NULL, INDEX IDX_D889A5DD7FF61858 (skills_id), INDEX IDX_D889A5DD709770DC (agents_id), PRIMARY KEY(skills_id, agents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE targets (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birth_date VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contacts_missions ADD CONSTRAINT FK_21A1513B719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contacts_missions ADD CONSTRAINT FK_21A1513B17C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EFF2F627D FOREIGN KEY (hideouts_id) REFERENCES hideouts (id)');
        $this->addSql('ALTER TABLE missions_agents ADD CONSTRAINT FK_5340AFB917C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_agents ADD CONSTRAINT FK_5340AFB9709770DC FOREIGN KEY (agents_id) REFERENCES agents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_targets ADD CONSTRAINT FK_B7328F6017C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_targets ADD CONSTRAINT FK_B7328F6043B5F743 FOREIGN KEY (targets_id) REFERENCES targets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skills_agents ADD CONSTRAINT FK_D889A5DD7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skills_agents ADD CONSTRAINT FK_D889A5DD709770DC FOREIGN KEY (agents_id) REFERENCES agents (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions_agents DROP FOREIGN KEY FK_5340AFB9709770DC');
        $this->addSql('ALTER TABLE skills_agents DROP FOREIGN KEY FK_D889A5DD709770DC');
        $this->addSql('ALTER TABLE contacts_missions DROP FOREIGN KEY FK_21A1513B719FB48E');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EFF2F627D');
        $this->addSql('ALTER TABLE contacts_missions DROP FOREIGN KEY FK_21A1513B17C042CF');
        $this->addSql('ALTER TABLE missions_agents DROP FOREIGN KEY FK_5340AFB917C042CF');
        $this->addSql('ALTER TABLE missions_targets DROP FOREIGN KEY FK_B7328F6017C042CF');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E7FF61858');
        $this->addSql('ALTER TABLE skills_agents DROP FOREIGN KEY FK_D889A5DD7FF61858');
        $this->addSql('ALTER TABLE missions_targets DROP FOREIGN KEY FK_B7328F6043B5F743');
        $this->addSql('DROP TABLE admins');
        $this->addSql('DROP TABLE agents');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE contacts_missions');
        $this->addSql('DROP TABLE hideouts');
        $this->addSql('DROP TABLE missions');
        $this->addSql('DROP TABLE missions_agents');
        $this->addSql('DROP TABLE missions_targets');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE skills_agents');
        $this->addSql('DROP TABLE targets');
    }
}