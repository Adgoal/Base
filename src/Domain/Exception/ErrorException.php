<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Domain\Exception;

use Exception;

/**
 * Class ErrorException.
 *
 * @category Exception
 */
class ErrorException extends Exception
{
    use ParentExceptionTrait;
}
