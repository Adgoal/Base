<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Domain\Entity;

/**
 * Contract for objects serializable.
 */
interface SerializableInterface
{
    /**
     * Deserialize data to object.
     *
     * @param mixed[] $data
     *
     * @return mixed The object instance
     */
    public static function deserialize(array $data);

    /**
     * Serialize object to array.
     *
     * @return mixed[]
     */
    public function serialize(): array;
}
