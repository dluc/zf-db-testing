<?php

/**
 * Users db table model
 *
 * Provide access to a db table storing users
 *
 * @package Demo Application
 * @author Devis Lucato <devis@ibuildings.com>
 * @copyright Ibuildings UK
 * @date November 2010
 */

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';
}