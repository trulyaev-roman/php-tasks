<?php

//class First
//{
//    public static function printMessage()
//    {
//        echo __CLASS__."\n";
//    }
//    public static function needMessage()
//    {
//        self::printMessage();
//    }
//}
//
//class Second extends First
//{
//    public static function printMessage()
//    {
//        echo __CLASS__."\n";
//    }
//}
//
//First::needMessage();
//
//Second::needMessage();


class First
{
    protected static function getClass()
    {
        return get_called_class();
    }
    public static function printClass()
    {
        echo static::getClass()."\n";
    }
}

class Second extends First
{
}

First::printClass();

Second::printClass();