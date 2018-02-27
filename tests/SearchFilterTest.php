<?php

use AppBundle\Model\SearchFilter;

class SearchFilterTest extends PHPUnit_Framework_TestCase
{
    public function testRemovesNullValuesFromOutputArray()
    {
        $withoutCategory = new SearchFilter(null, 2017, 01);
        $withoutYear = new SearchFilter('test-category', null, 01);
        $withoutMonth = new SearchFilter('test-category', 2017);

        $this->assertEquals(2, count($withoutCategory->toArray()));
        $this->assertEquals(2, count($withoutYear->toArray()));
        $this->assertEquals(2, count($withoutMonth->toArray()));
    }
}
