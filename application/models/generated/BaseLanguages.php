<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Languages', 'default');

/**
 * BaseLanguages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $lang_id
 * @property enum $lang_code
 * @property string $lang_name
 * @property Doctrine_Collection $FaqDetails
 * @property Doctrine_Collection $JobDetails
 * @property Doctrine_Collection $NewsDetails
 * @property Doctrine_Collection $PageDetails
 * @property Doctrine_Collection $PdfDetails
 * @property Doctrine_Collection $ProductDetails
 * @property Doctrine_Collection $TabDetails
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLanguages extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('languages');
        $this->hasColumn('lang_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('lang_code', 'enum', 5, array(
             'type' => 'enum',
             'length' => 5,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'en-us',
              1 => 'ar-eg',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('lang_name', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
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
        $this->hasMany('FaqDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('JobDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('NewsDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('PageDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('PdfDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('ProductDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));

        $this->hasMany('TabDetails', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));
    }
}