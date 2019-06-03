<?php

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Project\ExternalOAuth;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/http-api-projects-project.html#set-externaloauth
 * @method string getAction()
 * @method ProjectSetExternalOAuthAction setAction(string $action = null)
 * @method ExternalOAuth getExternalOAuth()
 * @method ProjectSetExternalOAuthAction setExternalOAuth(ExternalOAuth $externalOAuth = null)
 */
class ProjectSetExternalOAuthAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'externalOAuth' => [static::TYPE => ExternalOAuth::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setExternalOAuth');
    }

    /**
     * @param ExternalOAuth $externalOAuth
     * @param Context|callable $context
     * @return ProjectSetExternalOAuthAction
     */
    public static function ofExternalOAuth(ExternalOAuth $externalOAuth, $context = null)
    {
        return static::of($context)->setExternalOAuth($externalOAuth);
    }
}
