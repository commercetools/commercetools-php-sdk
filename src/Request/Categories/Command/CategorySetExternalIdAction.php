<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CategorySetDescriptionAction
 * @package Sphere\Core\Request\Categories\Command
 * @method string getExternalId()
 * @method CategorySetExternalIdAction setExternalId(string $externalId)
 */
class CategorySetExternalIdAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string']
        ];
    }

    public function __construct($externalId)
    {
        $this->setAction('setExternalId');
        $this->setExternalId($externalId);
    }
}
