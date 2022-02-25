<?php
function mb_ucfirst($s)
{
    return mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);
}