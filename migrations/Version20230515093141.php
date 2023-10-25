<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515093141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_logger (id SERIAL NOT NULL, user_token VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN api_logger.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE link (id SERIAL NOT NULL, user_id INT DEFAULT NULL, original_url VARCHAR(255) DEFAULT NULL, domain VARCHAR(255) DEFAULT NULL, short_url VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36AC99F1A76ED395 ON link (user_id)');
        $this->addSql('CREATE UNIQUE INDEX link_unique ON link (domain, short_url)');
        $this->addSql('COMMENT ON COLUMN link.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE links (id SERIAL NOT NULL, host VARCHAR(255) NOT NULL, short_url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D182A11883360531 ON links (short_url)');
        $this->addSql('CREATE TABLE logger (id SERIAL NOT NULL, qty INT NOT NULL, status VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN logger.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE response (id SERIAL NOT NULL, uuid VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, connection_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN response.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN response.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE role (id SERIAL NOT NULL, name VARCHAR(31) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE settings (id SERIAL NOT NULL, connection_id INT NOT NULL, domain VARCHAR(255) NOT NULL, check_url VARCHAR(255) DEFAULT NULL, protocol VARCHAR(255) NOT NULL, send_response_with_timeout BOOLEAN DEFAULT false NOT NULL, response_delay_time INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX domain_unique ON settings (connection_id, domain, protocol)');
        $this->addSql('COMMENT ON COLUMN settings.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE turn_connect_in (s_id SERIAL NOT NULL, s_user_id INT NOT NULL, s_connect_name TEXT NOT NULL, s_system_id TEXT NOT NULL, s_system_type TEXT NOT NULL, s_password TEXT NOT NULL, s_bind_type TEXT NOT NULL, s_run_pid INT NOT NULL, s_disable INT DEFAULT 1 NOT NULL, s_resp_window INT DEFAULT 5 NOT NULL, s_send_srcton SMALLINT DEFAULT -1 NOT NULL, s_send_srcnpi SMALLINT DEFAULT -1 NOT NULL, s_send_dstton SMALLINT DEFAULT -1 NOT NULL, s_send_dstnpi SMALLINT DEFAULT -1 NOT NULL, s_recv_srcton SMALLINT DEFAULT -1 NOT NULL, s_recv_srcnpi SMALLINT DEFAULT -1 NOT NULL, s_recv_dstton SMALLINT DEFAULT -1 NOT NULL, s_recv_dstnpi SMALLINT DEFAULT -1 NOT NULL, s_send_enquirelink BIGINT DEFAULT 60 NOT NULL, s_any_send_enquirelink BIGINT DEFAULT 0 NOT NULL, s_debug INT DEFAULT 1 NOT NULL, s_debug_dump INT DEFAULT 1 NOT NULL, s_sms_limit INT DEFAULT 0 NOT NULL, s_type_message_id SMALLINT DEFAULT 3 NOT NULL, maximum_connect_count SMALLINT DEFAULT 10 NOT NULL, protocol TEXT DEFAULT \'smpp\' NOT NULL, status_url TEXT DEFAULT \'\' NOT NULL, status_secret_key TEXT DEFAULT \'\' NOT NULL, allow_status_request INT DEFAULT 0 NOT NULL, smpp_extension BIGINT DEFAULT 0 NOT NULL, PRIMARY KEY(s_id))');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, role_id INT NOT NULL, user_name VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64924A232CF ON "user" (user_name)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON "user" (role_id)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE link DROP CONSTRAINT FK_36AC99F1A76ED395');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D60322AC');
        $this->addSql('DROP TABLE api_logger');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE links');
        $this->addSql('DROP TABLE logger');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE turn_connect_in');
        $this->addSql('DROP TABLE "user"');
    }
}
