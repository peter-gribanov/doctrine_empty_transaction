<?php
declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Migrations\AbortMigrationException;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180417153629CreateUserTable extends AbstractMigration
{
    /**
     * @throws DBALException
     * @throws AbortMigrationException
     *
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('
          CREATE TABLE user (
            id VARCHAR(11) NOT NULL,
            email VARCHAR(128) NOT NULL,
            password VARCHAR(255) NOT NULL,
            social_facebook_id INTEGER UNSIGNED DEFAULT NULL,
            social_google_id INTEGER UNSIGNED DEFAULT NULL,
            social_twitter_id INTEGER UNSIGNED DEFAULT NULL,
            profile_avatar VARCHAR(255) NOT NULL,
            profile_firstname VARCHAR(255) NOT NULL,
            profile_lastname VARCHAR(255) NOT NULL,
            profile_gender TEXT CHECK(profile_gender IN ("female", "male", "unknown")) NOT NULL,
            profile_birth_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id)
          )
        ');
        $this->addSql('CREATE UNIQUE INDEX user_idx_1 ON user (email)');

        $this->addSql('
            INSERT INTO
              user
            VALUES
              (?, ?, ?, NULL, NULL, NULL, "", "Alan", "Sanderson", "unknown", NULL)
        ', [
            'D1aeVyioKNs',
            'test@example.com',
            password_hash('12345', PASSWORD_BCRYPT, ['cost' => 12])
        ]);
    }

    /**
     * @throws AbortMigrationException
     * @throws DBALException
     *
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
    }
}
