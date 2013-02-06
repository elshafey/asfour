<?php

/**
 * JobDetailsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobDetailsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object JobDetailsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('JobDetails');
    }
    
    public static function getJobDetail($job_id, $lang_code = "") {
        $q = Doctrine_Query::create()
                ->select('jd.*')
                ->from('JobDetails jd,jd.Languages l')
                ->where('jd.job_id=?', $job_id);
        
        if($lang_code!='')
            $q->andWhere('l.lang_code=?', $lang_code);
            
        return $q->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
                ->execute();
    }
}