<?php

declare(strict_types=1);

namespace App\Shared\Database\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221019112830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table Users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, phone VARCHAR(12) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9444F97DD ON users (phone)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
