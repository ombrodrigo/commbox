<?php

/**
 * Classe responsável por escanear o input do tipo text
 *
 * @package Commbox\Core\Scanner
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Scanner;

use Commbox\Core\Scanner\AbstractScanner;

class Text extends AbstractScanner
{
    /**
     * @see Commbox\Core\Scanner\AbstractScanner::validate
     */
    protected function validate()
    {
        if (!isset($_POST) || !isset($_POST['letterInText']) || strlen($_POST['letterInText']) == 0) {
            return false;
        }

        return true;
    }

    /**
     * @see Commbox\Core\Scanner\AbstractScanner::getContent
     */
    protected function getContent()
    {
        return $_POST['letterInText'];
    }
}
