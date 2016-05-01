<?php
/**
 * Manager.php
 *
 * PHP version 5.6+
 *
 * @author Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2016 Philippe Gaultier
 * @license http://www.sweelix.net/license license
 * @version XXX
 * @link http://www.sweelix.net
 * @package sweelix\rbac\redis
 */

namespace sweelix\rbac\redis;

use Yii;
use yii\rbac\BaseManager;
use yii\rbac\Role;
use yii\rbac\Item;
use yii\redis\Connection;

/**
 * REDIS Manager represents an authorization manager that stores
 * authorization information in REDIS database
 *
 * @author Philippe Gaultier <pgaultier@sweelix.net>
 * @copyright 2010-2016 Philippe Gaultier
 * @license http://www.sweelix.net/license license
 * @version XXX
 * @link http://www.sweelix.net
 * @package application\controllers
 * @since XXX
 */
class Manager extends BaseManager
{
    /**
     * @var Connection|array|string the Redis DB connection object or the application component ID of the DB connection.
     */
    public $db = 'redis';

    /**
     * @var DataService
     */
    protected $dataService;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->dataService = new DataService(['db' => $this->db]);
    }

    /**
     * @inheritdoc
     */
    protected function getItem($name)
    {
        return $this->dataService->getItem($name);
    }

    /**
     * @inheritdoc
     */
    protected function getItems($type)
    {
        return $this->dataService->getItems($type);
    }

    /**
     * @inheritdoc
     */
    protected function addItem($item)
    {
        return $this->dataService->addItem($item);
    }

    /**
     * @inheritdoc
     */
    protected function addRule($rule)
    {
        return $this->dataService->addRule($rule);
    }

    /**
     * @inheritdoc
     */
    protected function removeItem($item)
    {
        return $this->dataService->removeItem($item);
    }

    /**
     * @inheritdoc
     */
    protected function removeRule($rule)
    {
        return $this->dataService->removeRule($rule);
    }

    /**
     * @inheritdoc
     */
    protected function updateItem($name, $item)
    {
        return $this->dataService->updateItem($name, $item);
    }

    /**
     * @inheritdoc
     */
    protected function updateRule($name, $rule)
    {
        return $this->dataService->updateRule($name, $rule);
    }

    /**
     * @inheritdoc
     */
    public function getRules()
    {
        return $this->dataService->getRules();
    }

    /**
     * @inheritdoc
     */
    public function getRule($name)
    {
        return $this->dataService->getRule($name);
    }

    /**
     * @inheritdoc
     */
    public function addChild($parent, $child)
    {
        return $this->dataService->addChild($parent, $child);
    }

    /**
     * @inheritdoc
     */
    public function removeChild($parent, $child)
    {
        return $this->dataService->removeChild($parent, $child);
    }

    /**
     * @inheritdoc
     */
    public function removeChildren($parent)
    {
        return $this->dataService->removeChildren($parent);
    }

    /**
     * @inheritdoc
     */
    public function getChildren($name)
    {
        return $this->dataService->getChildren($name);
    }

    /**
     * @inheritdoc
     */
    public function hasChild($parent, $child)
    {
        return $this->dataService->hasChild($parent, $child);
    }

    /**
     * @inheritdoc
     */
    public function revokeAll($userId)
    {
        return $this->dataService->revokeAll($userId);
    }

    /**
     * @inheritdoc
     */
    public function revoke($role, $userId)
    {
        return $this->dataService->revoke($role, $userId);
    }

    /**
     * @inheritdoc
     */
    public function removeAllRoles()
    {
        return $this->dataService->removeAllRoles();
    }

    /**
     * @inheritdoc
     */
    public function removeAllRules()
    {
        return $this->dataService->removeAllRules();
    }

    /**
     * @inheritdoc
     */
    public function removeAllPermissions()
    {
        return $this->dataService->removeAllPermissions();
    }

    /**
     * @inheritdoc
     */
    public function removeAll()
    {
        return $this->dataService->removeAll();
    }

    /**
     * @inheritdoc
     */
    public function removeAllAssignments()
    {
        return $this->dataService->removeAllAssignments();
    }

    /**
     * @inheritdoc
     */
    public function getRolesByUser($userId)
    {
        return $this->dataService->getRolesByUser($userId);
    }

    /**
     * @inheritdoc
     */
    public function getUserIdsByRole($roleName)
    {
        return $this->dataService->getUserIdsByRole($roleName);
    }

    /**
     * @inheritdoc
     */
    public function assign($role, $userId)
    {
        return $this->dataService->assign($role, $userId);
    }

    /**
     * @inheritdoc
     */
    public function getPermissionsByUser($userId)
    {
        return $this->dataService->getPermissionsByUser($userId);
    }

    /**
     * @inheritdoc
     */
    public function getPermissionsByRole($roleName)
    {
        return $this->dataService->getPermissionsByRole($roleName);
    }

    /**
     * @inheritdoc
     */
    public function getAssignments($userId)
    {
        return $this->dataService->getAssignments($userId);
    }

    /**
     * @inheritdoc
     */
    public function getAssignment($roleName, $userId)
    {
        return $this->dataService->getAssignment($roleName, $userId);
    }

    public function checkAccess($userId, $permissionName, $params = [])
    {
        $assignments = $this->getAssignments($userId);
        return $this->checkAccessRecursive($userId, $permissionName, $params, $assignments);
    }

    public function canAddChild(Item $parent, Item $child)
    {
        return $this->dataService->canAddChild($parent, $child);
    }

    protected function checkAccessRecursive($user, $itemName, $params, $assignments)
    {
        if (($item = $this->getItem($itemName)) === null) {
            return false;
        }
        Yii::trace($item instanceof Role ? "Checking role: $itemName" : "Checking permission: $itemName", __METHOD__);
        if (!$this->executeRule($user, $item, $params)) {
            return false;
        }
        if (isset($assignments[$itemName]) || in_array($itemName, $this->defaultRoles)) {
            return true;
        }
        $parents = $this->dataService->getParents($itemName);
        foreach ($parents as $parent) {
            if ($this->checkAccessRecursive($user, $parent, $params, $assignments)) {
                return true;
            }
        }
        return false;
    }
}
