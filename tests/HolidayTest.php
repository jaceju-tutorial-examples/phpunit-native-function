<?php

use Lab3\Holiday;

class HolidayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * 假如今天是聖誕節
     */
    public function today_should_be_xmas()
    {
        $holiday = new Holiday;

        $actual = $holiday->isTodayXmas();

        // @todo: 請移除下一行的註解，並想辦法通過測試
        // $this->assertTrue($actual);
    }

    /**
     * @test
     *
     * 假如今天不是聖誕節
     */
    public function today_should_be_not_xmas()
    {
        $holiday = new Holiday;

        $actual = $holiday->isTodayXmas();

        // @todo: 請移除下一行的註解，並想辦法通過測試
        // $this->assertFalse($actual);
    }
}
