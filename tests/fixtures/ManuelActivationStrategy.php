<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Fixtures;

use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;

class ManuelActivationStrategy implements ActivationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function isHandlerActivated(array $record)
    {
        return false;
    }

}
