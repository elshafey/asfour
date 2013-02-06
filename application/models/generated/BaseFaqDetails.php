<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('FaqDetails', 'default');

/**
 * BaseFaqDetails
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $detail_id
 * @property integer $faq_id
 * @property string $faq_question
 * @property string $faq_answer
 * @property integer $lang_id
 * @property Faqs $Faqs
 * @property Languages $Languages
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFaqDetails extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('faq_details');
        $this->hasColumn('detail_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('faq_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('faq_question', 'string', 500, array(
             'type' => 'string',
             'length' => 500,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('faq_answer', 'string', null, array(
             'type' => 'string',
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
        $this->hasOne('Faqs', array(
             'local' => 'faq_id',
             'foreign' => 'faq_id'));

        $this->hasOne('Languages', array(
             'local' => 'lang_id',
             'foreign' => 'lang_id'));
    }
}