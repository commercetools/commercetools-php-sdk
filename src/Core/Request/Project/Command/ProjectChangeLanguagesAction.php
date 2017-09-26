<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://dev.commercetools.com/http-api-projects-project.html#change-languages
 * @method string getAction()
 * @method ProjectChangeLanguagesAction setAction(string $action = null)
 * @method array getLanguages()
 * @method ProjectChangeLanguagesAction setLanguages(array $languages = null)
 */
class ProjectChangeLanguagesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'languages' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLanguages');
    }

    /**
     * @param array $languages
     * @param Context|callable $context
     * @return ProjectChangeLanguagesAction
     */
    public static function ofLanguages($languages, $context = null)
    {
        return static::of($context)->setLanguages($languages);
    }
}
