<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Infrastructure\Testing;

use AdgoalCommon\Base\Domain\ValueObject\Collection;
use AdgoalCommon\Base\Domain\ValueObject\Integer as ValueObjectInteger;
use AdgoalCommon\Base\Domain\ValueObject\ObjectStorage;
use AdgoalCommon\Base\Domain\ValueObject\StringLiteral;
use Mockery;
use Mockery\MockInterface;
use Ramsey\Uuid\Uuid;

/**
 * Trait ValueObjectMockTrait.
 *
 * @category Tests\Unit\Utils
 */
trait ValueObjectMockTrait
{
    /**
     * Create Uuid mock.
     *
     * @param string   $uuid
     * @param int|null $times
     *
     * @return MockInterface|Uuid
     *
     * @SuppressWarnings(PHPMD)
     */
    protected function createUuidMock(string $uuid, ?int $times = 0): MockInterface
    {
        $mock = Mockery::mock(Uuid::class);
        $uuidMockedToStringMethod = $mock
            ->shouldReceive('toString');

        if (null === $times) {
            $uuidMockedToStringMethod->zeroOrMoreTimes();
        } else {
            $uuidMockedToStringMethod->times($times);
        }
        $uuidMockedToStringMethod->andReturn($uuid);

        return $mock;
    }

    /**
     * Create StringLiteral mock.
     *
     * @param string $string
     * @param int    $times
     *
     * @return MockInterface|StringLiteral
     */
    protected function createStringLiteralMock(string $string, int $times = 0): MockInterface
    {
        $mock = Mockery::mock(StringLiteral::class);
        $mock
            ->shouldReceive('toString')
            ->times($times)
            ->andReturn($string);

        return $mock;
    }

    /**
     * Create Integer mock.
     *
     * @param int $integer
     * @param int $times
     *
     * @return MockInterface|ValueObjectInteger
     */
    protected function createIntegerMock(int $integer, int $times = 0): MockInterface
    {
        $mock = Mockery::mock(ValueObjectInteger::class);
        $mock
            ->shouldReceive('toNative')
            ->times($times)
            ->andReturn($integer);

        $mock
            ->shouldReceive('inc')
            ->times(0)
            ->andReturn(++$integer);

        return $mock;
    }

    /**
     * Create ObjectStorage mock.
     *
     * @param mixed[] $data
     * @param int     $times
     *
     * @return MockInterface|ObjectStorage
     */
    protected function createObjectStorageMock(array $data, int $times = 0): MockInterface
    {
        $mock = Mockery::mock(ObjectStorage::class);
        $mock
            ->shouldReceive('toArray')
            ->times($times)
            ->andReturn($data);

        return $mock;
    }

    /**
     * Create Collection mock.
     *
     * @param mixed[] $data
     * @param int     $times
     *
     * @return MockInterface|Collection
     */
    protected function createCollectionMock(array $data, int $times = 0): MockInterface
    {
        $mock = Mockery::mock(Collection::class);
        $mock
            ->shouldReceive('toArray')
            ->times($times)
            ->andReturn($data);

        return $mock;
    }
}
