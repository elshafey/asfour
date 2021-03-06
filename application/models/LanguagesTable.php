<?php

/**
 * LanguagesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LanguagesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LanguagesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Languages');
    }
    
    public static function getLanguage($default="en-us")
    {
        return Doctrine_Query::create()
                ->from('Languages lang')
                ->where("lang.lang_code='$default'")
                ->setHydrationMode(Doctrine_core::HYDRATE_ARRAY)
                ->fetchOne();
    }
    
    public static function getLanguages()
    {
        $langs= Doctrine_Query::create()
                ->from('Languages lang')
                ->setHydrationMode(Doctrine_core::HYDRATE_ARRAY)
                ->execute();
        $array=array();
        foreach ($langs as $value) {
            $array['ids'][$value['lang_id']]=$value;
            $array['codes'][$value['lang_code']]=$value;
        }
        
        return $array;
    }
}