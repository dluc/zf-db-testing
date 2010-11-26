<?php

/**
 * Data mapper test case
 *
 * Test CRUD operations against a testing database validating the result with XML files
 *
 * @package Test Application
 * @author Devis Lucato <devis@ibuildings.com>
 * @copyright Ibuildings UK
 * @date November 2010
 */

require '../library/Ibuildings/Test/PHPUnit/DatabaseTestCase/Abstract.php';

class Application_Model_UserMapperTest extends Ibuildings_Test_PHPUnit_DatabaseTestCase_Abstract
{
    protected $_initialSeedFile = 'usersSeed.xml';

    /**
     * CRUD Test: CREATE
     */
    public function testCreateUsers()
    {
        $data = array(
            'username' => 'user3',
            'password' => 'z1123581',
            'email'    => 'user3@example.com',
            'name'     => 'John' );

        $user = new Application_Model_User($data);

        $userMapper = new Application_Model_UserMapper();

        // exercise
        $userMapper->save($user);

        // get data from the testing database
        $dataSet = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet($this->getConnection());
        $dataSet->addTable('users', 'SELECT * FROM users');
        $dataSet->addTable('administrators', 'SELECT * FROM administrators');

        // verify expected vs actual
        $this->assertDataSetsMatchXML('usersInsertIntoAssertion.xml', $dataSet);
    }

    /**
     * CRUD Test: RETRIEVE
     */
    public function testRetrieveOneUser()
    {
        $recordId = 2;

        $userMapper = new Application_Model_UserMapper();

        // exercise
        $user = $userMapper->find($recordId);

        // convert array to a comparable dataset
        $dataSet = $this->convertRecordToDataSet($user->toArray(), 'users');

        // verify expected vs actual
        $this->assertDataSetsMatchXML('usersRetrieveOneAssertion.xml', $dataSet);
    }

    /**
     * CRUD Test: UPDATE
     */
    public function testUpdateUser()
    {
        $recordId = 2;

        $data = array(
            'password' => 'newpassword',
            'name'     => 'No name',
        );

        $userMapper = new Application_Model_UserMapper();

        $user = $userMapper->find($recordId);

        $user->setPassword($data['password']);
        $user->setName($data['name']);

        // exercise
        $userMapper->save($user);

        // get data from the testing database
        $dataSet = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet($this->getConnection());
        $dataSet->addTable('users', 'SELECT * FROM users');
        $dataSet->addTable('administrators', 'SELECT * FROM administrators');

        // verify expected vs actual
        $this->assertDataSetsMatchXML('usersUpdateAssertion.xml', $dataSet);
    }

    /**
     * CRUD Test: DELETE
     */
    public function testDeleteUser()
    {
        $recordId = 1;

        $userMapper = new Application_Model_UserMapper();

        $user = $userMapper->find($recordId);

        // exercise
        $userMapper->delete($user);

        // get data from the testing database
        $dataSet = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet($this->getConnection());
        $dataSet->addTable('users', 'SELECT * FROM users');
        $dataSet->addTable('administrators', 'SELECT * FROM administrators');

        // verify expected vs actual
        $this->assertDataSetsMatchXML('usersDeleteAssertion.xml', $dataSet);
    }
}