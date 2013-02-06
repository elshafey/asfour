<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ProductDetails', 'default');

/**
 * BaseProductDetails
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $detail_id
 * @property integer $prod_id
 * @property string $prod_title
 * @property string $prod_description
 * @property string $prod_summary
 * @property integer $lang_id
 * @property Products $Products
 * @property Languages $Languages
 * @property Doctrine_Collection $MediaContacts
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductDetails extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('product_details');
        $this->hasColumn('detail_id', 'integer', 4, array(
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
        $this->hasColumn('prod_title', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('prod_description', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('prod_summary', 'string', 500, array(
             'type' => 'string',
             'length' => 500,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('lang_id', 'integer', 4, array(
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

        $this->hasOne('Languages', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('MediaContacts', array(
             'local' => 'detail_id',
             'foreign' => 'product_details_id'));
    }
}