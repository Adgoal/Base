<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Domain\Service;

/**
 * Contract for objects normalize by the NormalizebleDto.
 */
interface NormalizableServiceInterface
{
    /**
     * Denormalize array to object.
     *
     * @param mixed[] $data
     *
     * @return object
     */
    public function denormalize(array $data): object;

    /**
     * Nermolize object to array.
     *
     * @param object $object
     *
     * @return mixed[]
     */
    public function normalize(object $object): array;
}
