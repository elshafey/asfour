<?php

/**
 * TabImagesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TabImagesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TabImagesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('TabImages');
    }
    
    public static function getTabImages($tab_id,$active_only=false){
        $q= Doctrine_Query::create()
                ->from('TabImages')
                ->where('tab_id=?',$tab_id)
                ->orderBy('image_order ASC')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);
        if($active_only)
            $q->andWhere('image_is_active=1');
        
        return $q->execute();
    }
}