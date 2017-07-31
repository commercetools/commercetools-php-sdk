<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

use Ramsey\Uuid\Uuid;

class DefaultCorrelationIdProvider implements CorrelationIdProvider
{
    private $projectKey;

    public function __construct($projectKey = null)
    {
        $projectKey = !empty($projectKey) ? $projectKey : 'php';
        $this->projectKey = $projectKey;
    }

    public function getCorrelationId()
    {
        return sprintf('%s/%s', $this->projectKey, Uuid::uuid4()->toString());
    }

    /**
     * Returns an instance if ramsay\uuid package is installed
     * @param string $projectKey
     * @return DefaultCorrelationIdProvider|null
     */
    public static function of($projectKey)
    {
        if (class_exists('\Ramsey\Uuid\Uuid')) {
            return new DefaultCorrelationIdProvider($projectKey);
        }
        return null;
    }
}
