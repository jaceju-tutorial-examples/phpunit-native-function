<?php

namespace Lab3;

class Holiday
{
    public function isTodayXmas()
    {
        shell_exec('command_for_production');
        return '12/25' === date('m/d');
    }
}
