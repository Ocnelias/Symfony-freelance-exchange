<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020113605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job CHANGE status status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F88BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE migration CHANGE version version VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP role, DROP auth_key, CHANGE password_hash password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_from_message');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_to_message');
        $this->addSql('ALTER TABLE message ADD is_system INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FB91AA170 FOREIGN KEY (`from`) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FD787D2C4 FOREIGN KEY (`to`) REFERENCES user (id)');
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_user_id_portfolio');
        $this->addSql('ALTER TABLE portfolio CHANGE `order` `order` INT DEFAULT NULL');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tag CHANGE parent_id parent_id INT NOT NULL');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_lang_id_language');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_user_id_language');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B5B213FA4 FOREIGN KEY (lang_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_job_id_offer');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_user_id_offer');
        $this->addSql('ALTER TABLE offer DROP updated_at');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_category_id_education');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_user_id_education');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT NOT NULL');
        $this->addSql('ALTER TABLE profileSearch DROP FOREIGN KEY FK_user_id_profileSearch');
        $this->addSql('ALTER TABLE profileSearch CHANGE status status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE profileSearch ADD CONSTRAINT FK_CEB0ADDFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_category_id_profile');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_city_id_profile');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_country_id_profile');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_user_id_profile');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_category_id_experience');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_user_id_experience');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED212469DE2');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2A76ED395');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_category_id_education FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_user_id_education FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10312469DE2');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103A76ED395');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_category_id_experience FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_user_id_experience FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F812469DE2');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F88BAC62AF');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8F92F3E70');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8A76ED395');
        $this->addSql('ALTER TABLE job CHANGE status status SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B5B213FA4');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B5A76ED395');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_lang_id_language FOREIGN KEY (lang_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_user_id_language FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FB91AA170');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FD787D2C4');
        $this->addSql('ALTER TABLE message DROP is_system');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_from_message FOREIGN KEY (`from`) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_to_message FOREIGN KEY (`to`) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE migration CHANGE version version VARCHAR(180) NOT NULL COLLATE utf8_bin');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EBE04EA9');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EA76ED395');
        $this->addSql('ALTER TABLE offer ADD updated_at INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_job_id_offer FOREIGN KEY (job_id) REFERENCES job (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_user_id_offer FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062A76ED395');
        $this->addSql('ALTER TABLE portfolio CHANGE `order` `order` INT DEFAULT 0');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_user_id_portfolio FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F12469DE2');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F8BAC62AF');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FF92F3E70');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_category_id_profile FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_city_id_profile FOREIGN KEY (city_id) REFERENCES city (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_country_id_profile FOREIGN KEY (country_id) REFERENCES country (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_user_id_profile FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE profileSearch DROP FOREIGN KEY FK_CEB0ADDFA76ED395');
        $this->addSql('ALTER TABLE profileSearch CHANGE status status SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE profileSearch ADD CONSTRAINT FK_user_id_profileSearch FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tag CHANGE parent_id parent_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_unicode_ci, ADD auth_key VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, DROP roles, CHANGE password password_hash VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
