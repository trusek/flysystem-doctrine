<?php

namespace WGG\Flysystem\Doctrine\Tests;

use Doctrine\DBAL\DriverManager;
use League\Flysystem\AdapterTestUtilities\FilesystemAdapterTestCase;
use League\Flysystem\FilesystemAdapter;
use WGG\Flysystem\Doctrine\DoctrineDBALAdapter;

use function dirname;

/**
 * @covers \WGG\Flysystem\Doctrine\DoctrineDBALAdapter
 */
class DoctrineDBALAdapterWithPrefixTest extends FilesystemAdapterTestCase
{
    protected static function createFilesystemAdapter(): FilesystemAdapter
    {
        $connection = DriverManager::getConnection([
            'url' => 'sqlite:///:memory:',
        ]);

        $connection->executeStatement((string) file_get_contents(dirname(__DIR__).'/schema/sqlite.sql'));

        return new DoctrineDBALAdapter(connection: $connection, prefix: 'prefix_test');
    }
}
