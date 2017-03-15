<?php
/**
 * TestRule.php
 *
 * PHP version 5.6+
 *
 * @author pgaultier
 * @copyright 2010-2017 Ibitux
 * @license http://www.ibitux.com/license license
 * @version XXX
 * @link http://www.ibitux.com
 */

namespace tests\unit;

use yii\rbac\Rule;

class TestRule extends Rule
{
    public function execute($user, $item, $params)
    {
        // TODO: Implement execute() method.
        return true;
    }
}