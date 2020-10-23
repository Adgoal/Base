<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Application\Factory;

use AdgoalCommon\Base\Application\Command\CommandInterface;

/**
 * Interface CommandFactoryInterface.
 *
 * @category Command
 */
interface CommandFactoryInterface
{
    /**
     * Make CommandBus command instance by constant type.
     *
     * @param mixed... $args
     *
     * @return CommandInterface
     */
    public function makeCommandInstanceByType(...$args): CommandInterface;
}
