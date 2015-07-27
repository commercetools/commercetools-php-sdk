<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Project;


use Sphere\Core\RequestTestCase;

class ProjectGetRequestTest extends RequestTestCase
{
    public function testMapResult()
    {
        $result = $this->mapResult(ProjectGetRequest::of());
        $this->assertInstanceOf('\Sphere\Core\Model\Project\Project', $result);
    }
}
