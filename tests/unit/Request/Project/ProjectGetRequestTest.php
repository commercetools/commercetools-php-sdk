<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project;

use Commercetools\Core\RequestTestCase;

class ProjectGetRequestTest extends RequestTestCase
{
    public function testMapResult()
    {
        $result = $this->mapResult(ProjectGetRequest::of());
        $this->assertInstanceOf('\Commercetools\Core\Model\Project\Project', $result);
    }
}
