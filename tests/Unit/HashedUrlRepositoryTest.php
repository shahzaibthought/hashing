<?php

namespace Tests\Unit;

use App\HashedUrlRepository;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class HashedUrlRepositoryTest extends TestCase
{
    /**
     * @var HashedUrlRepository
     */
    private $hashedUrlRepository;

    /**
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->hashedUrlRepository = app(HashedUrlRepository::class);
    }

    /**
     * @return array
     */
    public function providerTestClicksToInsert() : array
    {
        return [
            [
                1,
                2,
            ],
            [
                10,
                11,
            ],
            [
                100,
                101,
            ],
        ];
    }

    /**
     * @dataProvider providerTestClicksToInsert
     *
     * @return void
     */
    public function testClicksToInsert(int $existingClicks, int $expectedClicksToInsert)
    {
        $hashedUrlRepository = new ReflectionClass(HashedUrlRepository::class);
        $method = $hashedUrlRepository->getMethod('clicksToInsert');
        $method->setAccessible(true);
        $actualClicksToInsert = $method->invokeArgs($this->hashedUrlRepository, [$existingClicks]);

        $this->assertSame($expectedClicksToInsert, $actualClicksToInsert);
    }

    /**
     * @return array
     */
    public function providerTestGenerateHash() : array
    {
        return [
            [
                '1',
                '83dcefb7',
            ],
            [
                '100',
                '237750ea',
            ],
            [
                '4294967294',
                '2cccf8dd',
            ]
        ];
    }

    /**
     * @dataProvider providerTestGenerateHash
     *
     * @return void
     */
    public function testGenerateHash(string $valueToBeHashed, string $expectedHash)
    {
        $hashedUrlRepository = new ReflectionClass(HashedUrlRepository::class);
        $method = $hashedUrlRepository->getMethod('generateHash');
        $method->setAccessible(true);
        $actualHash = $method->invokeArgs($this->hashedUrlRepository, [$valueToBeHashed]);

        $this->assertSame($expectedHash, $actualHash);
    }
}
