<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use Commercetools\Core\Helper\Annotate\AnnotationGenerator;

require '../vendor/autoload.php';

$path = __DIR__ . '/../src/';

$generator = new AnnotationGenerator();
$generator->run($path);
