<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Controller\Controller;
use App\Controller\IndexController;
use App\Controller\TimeController;
use Switon\Testing\TestCase;

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

    public function testIndexActionReturnsWelcomePayload(): void
    {
        $controller = new IndexController();

        $payload = $controller->indexAction();

        self::assertSame(['message' => 'Welcome to Switon'], $payload);
    }

    public function testCurrentActionReturnsIso8601TimeString(): void
    {
        $controller = new TimeController();

        $payload = $controller->currentAction();

        self::assertArrayHasKey('time', $payload);
        self::assertIsString($payload['time']);
        self::assertMatchesRegularExpression(
            '/^\d{4}-\d{2}-\d{2}T/',
            $payload['time'],
            'time field should be ISO-8601-style from date("c")'
        );
    }
}
