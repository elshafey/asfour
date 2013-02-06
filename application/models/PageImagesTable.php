<?php

/**
 * PageImagesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PageImagesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PageImagesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PageImages');
    }
    
    public static function getPageImages($page_id){
        return Doctrine_Query::create()
                ->from('PageImages')
                ->where('page_id=? AND image_is_active=?',array($page_id,1))
                ->orderBy('image_order ASC')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}