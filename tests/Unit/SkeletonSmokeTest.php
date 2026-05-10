<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Controller\Controller;
use PHPUnit\Framework\TestCase;

/**
 * Minimal example: add more tests under tests/Unit or tests/Integration.
 *
 * Run: composer test
 * Or:  vendor/bin/phpunit --configuration tests/phpunit.xml.dist
 */
final class SkeletonSmokeTest extends TestCase
{
    public function testPhpVersionIsAtLeast83(): void
    {
        self::assertTrue(
            version_compare(PHP_VERSION, '8.3.0', '>='),
            'Switon skeleton requires PHP 8.3+'
        );
    }

    public function testAppControllerBaseIsAutoloaded(): void
    {
        self::assertTrue(class_exists(Controller::class));
    }
}
