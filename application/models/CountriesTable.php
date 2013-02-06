<?php

/**
 * CountriesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CountriesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CountriesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Countries');
    }
    public static function getCountries($for_worldwide=false){
        
        $q=Doctrine_Query::create()
                ->select('c.*')
                ->from('Countries c')
                ->orderBy('country_name ASC')
                ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY);
        if($for_worldwide){
            $q->innerJoin('c.Agents');
        }
        return $q->execute();
    }
}