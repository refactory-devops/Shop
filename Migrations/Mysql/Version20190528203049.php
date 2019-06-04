<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migration: Initial setup domain
 */
class Version20190528203049 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Initial setup domain';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('CREATE TABLE rfy_shop_domain_model_order (persistence_object_identifier VARCHAR(40) NOT NULL, ordernumber VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, modifiedat DATETIME NOT NULL, totalprice DOUBLE PRECISION NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rfy_shop_domain_model_product (persistence_object_identifier VARCHAR(40) NOT NULL, primaryimage VARCHAR(40) DEFAULT NULL, createdat DATETIME NOT NULL, modifiedat DATETIME NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, images VARCHAR(255) NOT NULL, originalprice DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, instock INT NOT NULL, views INT NOT NULL, purchased INT NOT NULL, favoured INT NOT NULL, INDEX IDX_90975CBC318B2B8C (primaryimage), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rfy_shop_domain_model_transaction (persistence_object_identifier VARCHAR(40) NOT NULL, `order` VARCHAR(40) DEFAULT NULL, createdby VARCHAR(40) DEFAULT NULL, transactiondate DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_237EE15BF5299398 (`order`), INDEX IDX_237EE15B46D262E0 (createdby), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rfy_shop_domain_model_orderline (persistence_object_identifier VARCHAR(40) NOT NULL, `order` VARCHAR(40) DEFAULT NULL, product VARCHAR(40) DEFAULT NULL, createdat DATETIME NOT NULL, modifiedat DATETIME NOT NULL, quantity INT NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_E94D5B67F5299398 (`order`), INDEX IDX_E94D5B67D34A04AD (product), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_product ADD CONSTRAINT FK_90975CBC318B2B8C FOREIGN KEY (primaryimage) REFERENCES neos_media_domain_model_asset (persistence_object_identifier)');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_transaction ADD CONSTRAINT FK_237EE15BF5299398 FOREIGN KEY (`order`) REFERENCES rfy_shop_domain_model_order (persistence_object_identifier)');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_transaction ADD CONSTRAINT FK_237EE15B46D262E0 FOREIGN KEY (createdby) REFERENCES neos_party_domain_model_person (persistence_object_identifier)');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_orderline ADD CONSTRAINT FK_E94D5B67F5299398 FOREIGN KEY (`order`) REFERENCES rfy_shop_domain_model_order (persistence_object_identifier)');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_orderline ADD CONSTRAINT FK_E94D5B67D34A04AD FOREIGN KEY (product) REFERENCES rfy_shop_domain_model_product (persistence_object_identifier)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('ALTER TABLE rfy_shop_domain_model_transaction DROP FOREIGN KEY FK_237EE15BF5299398');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_orderline DROP FOREIGN KEY FK_E94D5B67F5299398');
        $this->addSql('ALTER TABLE rfy_shop_domain_model_orderline DROP FOREIGN KEY FK_E94D5B67D34A04AD');
        $this->addSql('DROP TABLE rfy_shop_domain_model_order');
        $this->addSql('DROP TABLE rfy_shop_domain_model_product');
        $this->addSql('DROP TABLE rfy_shop_domain_model_transaction');
        $this->addSql('DROP TABLE rfy_shop_domain_model_orderline');
    }
}