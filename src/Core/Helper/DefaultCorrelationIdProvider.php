<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

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
        return sprintf('%s/%s', $this->projectKey, Uuid::uuidv4());
    }

    /**
     * Returns an instance if ramsay\uuid package is installed
     * @param string $projectKey
     * @return DefaultCorrelationIdProvider|null
     */
    public static function of($projectKey)
    {
        if (Uuid::active()) {
            return new DefaultCorrelationIdProvider($projectKey);
        }
        return null;
    }
}
