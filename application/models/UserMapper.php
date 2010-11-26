<?php

/**
 * Users data mapper
 *
 * Map users data to db tables, caching data with an identity map
 * Note: identity map can be removed, depending on use cases.
 *
 * @package Demo Application
 * @author Devis Lucato <devis@ibuildings.com>
 * @copyright Ibuildings UK
 * @date November 2010
 */

class Application_Model_UserMapper
{
    /**
     * @var Zend_Db_Table_Abstract Storage
     */
    protected $_dbTable;

    /**
     * @var array Identity map
     */
    protected $_loadedMap;

    /**
     * Set storage
     * @param  string|Zend_Db_Table_Abstract $dbTable
     * @return Application_Model_UserMapper
     */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    /**
     * Get storage
     * @return Zend_Db_Table_Abstract
     */
    public function getDbTable()
    {
        if (NULL === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }

    /**
     * Save user
     * @param  Application_Model_User $user
     * @return Application_Model_UserMapper
     */
    public function save(Application_Model_User $user)
    {
        if (!$user instanceof Application_Model_User) {
            throw new Exception('Invalid object type provided');
        }

        $data = array(
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'email'    => $user->getEmail(),
            'name'     => $user->getName(),
        );

        if (NULL === ($id = $user->getId())) {
            $table = $this->getDbTable();
            // save
            $table->insert($data);
            // get ID
            $id = $table->getAdapter()->lastInsertId();
            $user->setId($id);

            $this->_loadedMap[$id] = $user;
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }

        return $this;
    }

    /**
     * Find one user by ID
     * @param  $id
     * @return Application_Model_User|null
     */
    public function find($id)
    {
        if (!$id)
            return NULL;

        if (isset($this->_loadedMap[$id]))
            return $this->_loadedMap[$id];

        $rowset = $this->getDbTable()->find(array('id = ?' => $id));

        if ($rowset->count() == 0)
            return NULL;

        $row = $rowset->current();

        $data = array(
            'id'       => $row->id,
            'username' => $row->username,
            'password' => $row->password,
            'email'    => $row->email,
            'name'     => $row->name,
        );

        $this->_loadedMap[$id] = new Application_Model_User($data);

        return $this->_loadedMap[$id];
    }

    /**
     * Delete a user
     * @param Application_Model_User $user
     * @return void
     */
    public function delete(Application_Model_User $user)
    {
        if (NULL === ($id = $user->getId())) {
            throw new Exception('Object ID not set');
        } else {
            unset($this->_loadedMap[$id]);
            $this->getDbTable()->delete(array('id = ?' => $id));
        }
    }
}