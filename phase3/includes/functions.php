<?php
//Utility Functions

/**
 * Class UtilFunctions
 * Abstract class providing common utility functions for web site
 */
abstract class UtilFunction
{
    //Abstract methods - must be implemented by sub classes
    public abstract function showHeader();
    public abstract function getTopNav();

    /**
     * Method to redirect unauthorized user
     * @param $token
     * @param $location
     */
    public function isAllowed($token,$location)
    {
        if (!isset($_SESSION[$token])) {
            header("Location: $location");
        }
    }

    /**
     * Method to display the footer
     * @return string
     */
    public function getFooter()
    {
        return "<footer>&copy;2020 Christian Hur. I own this!</footer>";
    }

}