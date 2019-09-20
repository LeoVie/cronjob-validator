<?php

namespace LeoVie\CronjobValidator\Test\Unit\Cronjob;

use LeoVie\CronjobValidator\Cronjob\CronjobValidator;
use LeoVie\CronjobValidator\Exception\InvalidCronjobException;
use PHPUnit\Framework\TestCase;

class CronjobValidatorTest extends TestCase
{
    /** @var CronjobValidator */
    private $cronjobValidator;

    public function setUp(): void
    {
        $this->cronjobValidator = new CronjobValidator();
    }

    /** @dataProvider cronjobFormatIsValid_provider */
    public function test_cronjobFormatIsValid_throwsIfInvalid(string $cronjob, bool $shouldThrow): void
    {
        if ($shouldThrow) {
            self::expectException(InvalidCronjobException::class);
        } else {
            self::expectNotToPerformAssertions();
        }

        $this->cronjobValidator->validateCronjob($cronjob);
    }

    public function cronjobFormatIsValid_provider(): array
    {
        return [
            ['@daily curl http://localhost', false],
            ['* * * * * curl http://localhost', false],
            ['/15 * * * * curl http://localhost', false],
            ['/15 * * * 7 curl http://localhost', false],
            ['* * * * curl http://localhost', true],
            ['60 * * * * curl http://localhost', true],
            ['* 24 * * * curl http://localhost', true],
            ['* * 32 * * curl http://localhost', true],
            ['* * * 13 * curl http://localhost', true],
            ['* * * * 8 curl http://localhost', true],
        ];
    }
}