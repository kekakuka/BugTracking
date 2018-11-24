<?php
/**
 * Created by PhpStorm.
 * User: 39260
 * Date: 7/10/2018
 * Time: 4:29 PM
 */

namespace App\Http\Controllers;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator as BasePaginator;

class PageData {

    public $PageIndex ;
    public $TotalPages;
    public $NewItems;

       public function __construct(Collection $items,$pageIndex,$pageSize)
        {
            $this->PageIndex = $pageIndex;
            $count=$items->count();
            $this->TotalPages = (int)ceil($count/$pageSize);

            $this->NewItems=$items->forPage($pageIndex,$pageSize);
        }


        public function HasPreviousPage()
        {
                return $this->PageIndex > 1;
        }

    public function HasMorePage()
        {
                return $this->PageIndex < $this->TotalPages;
        }


}