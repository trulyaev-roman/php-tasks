<?php

class First
{
    public static function printMessage()
    {
        echo __CLASS__."\n";
    }
}

class Second extends First
{
}

First::printMessage();

Second::printMessage();