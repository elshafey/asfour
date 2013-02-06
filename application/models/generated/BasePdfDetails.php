<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PdfDetails', 'default');

/**
 * BasePdfDetails
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $detail_id
 * @property integer $pdf_id
 * @property string $pdf_title
 * @property integer $lang_id
 * @property ProductPdfs $ProductPdfs
 * @property Languages $Languages
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePdfDetails extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pdf_details');
        $this->hasColumn('detail_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('pdf_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('pdf_title', 'string', 500, array(
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
        $this->hasOne('ProductPdfs', array(
             'local' => 'pdf_id',
             'foreign' => 'pdf_id'));

        $this->hasOne('Languages', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));
    }
}