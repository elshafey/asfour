<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ProductAgents', 'default');

/**
 * BaseProductAgents
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $prod_agent_id
 * @property integer $prod_id
 * @property integer $agent_id
 * @property Products $Products
 * @property Agents $Agents
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductAgents extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('product_agents');
        $this->hasColumn('prod_agent_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('prod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('agent_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Products', array(
             'local' => 'prod_id',
             'foreign' => 'prod_id'));

        $this->hasOne('Agents', array(
             'local' => 'agent_id',
             'foreign' => 'agent_id'));
    }
}