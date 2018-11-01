<?php
/**
 * Created by PhpStorm.
 * User: 39260
 * Date: 17/10/2018
 * Time: 12:56 PM
 */

namespace App;


class BugDate
{
    public  $date;
    public  $countOpen=0;
    public  $countClosed=0;
    function __construct($date)
    {
        $this->date=$date;
    }

    public function addOpen(){
        $this->countOpen++;
    }
    public function addClosed(){
        $this->countClosed++;
    }
}