<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Application\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface CommandInterface.
 *
 * @category Command
 */
interface CommandInterface
{
    /**
     * Return Uuid.
     *
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface;
}
