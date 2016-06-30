<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CustomField
 * @link https://dev.commercetools.com/http-api-projects-custom-fields.html#customfieldsdraft
 * @method CustomFieldObjectDraftCollection add(CustomFieldObjectDraft $element)
 * @method CustomFieldObjectDraft current()
 * @method CustomFieldObjectDraft getAt($offset)
 */
class CustomFieldObjectDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\CustomField\CustomFieldObjectDraft';
}
