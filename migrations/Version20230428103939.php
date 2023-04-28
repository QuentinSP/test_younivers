<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428103939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $mdp = '"$2y$13$KcJdhhD2b9x.EhhSHkFJ9u94dc/10kjqnKAJ9kbVKFWec3bGYKWFG"';
        $this->addSql("INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `created_at`) 
                    VALUES (NULL, 'contact@younivers.fr', '{\"0\": \"ROLE_SUPER_ADMIN\"}', $mdp, 
                            'You', 'Nivers', '2023-04-28 13:21:59')");
    }
}
