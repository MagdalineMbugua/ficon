<?php
declare(strict_types=1);

use Elastic\Adapter\Indices\Mapping;
use Elastic\Adapter\Indices\Settings;
use Elastic\Migrations\Facades\Index;
use Elastic\Migrations\MigrationInterface;

final class CreatePostIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('posts', function (Mapping $mapping, Settings $settings) {
            $mapping->integer('id');
            $mapping->text('caption');
            $mapping->boolean('on_sale');
            $mapping->integer('created_by');
            $mapping->integer('updated_by');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('posts');
    }
}
