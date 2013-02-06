<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ProductTabs', 'default');

/**
 * BaseProductTabs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $tab_id
 * @property integer $prod_id
 * @property integer $tab_order
 * @property integer $tab_is_active
 * @property Products $Products
 * @property Doctrine_Collection $ProductPdfs
 * @property Doctrine_Collection $TabDetails
 * @property Doctrine_Collection $TabImages
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductTabs extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('product_tabs');
        $this->hasColumn('tab_id', 'integer', 4, array(
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
        $this->hasColumn('tab_order', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('tab_is_active', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
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

        $this->hasMany('ProductPdfs', array(
             'local' => 'tab_id',
             'foreign' => 'tab_id'));

        $this->hasMany('TabDetails', array(
             'local' => 'tab_id',
             'foreign' => 'tab_id'));

        $this->hasMany('TabImages', array(
             'local' => 'tab_id',
             'foreign' => 'tab_id'));
    }
}