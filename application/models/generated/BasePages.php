<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pages', 'default');

/**
 * BasePages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $page_id
 * @property string $slug
 * @property string $page_banner
 * @property Doctrine_Collection $PageDetails
 * @property Doctrine_Collection $PageImages
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePages extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pages');
        $this->hasColumn('page_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('slug', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('page_banner', 'string', 500, array(
             'type' => 'string',
             'length' => 500,
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
        $this->hasMany('PageDetails', array(
             'local' => 'page_id',
             'foreign' => 'page_id'));

        $this->hasMany('PageImages', array(
             'local' => 'page_id',
             'foreign' => 'page_id'));
    }
}