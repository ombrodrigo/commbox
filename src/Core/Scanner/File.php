<?php

/**
 * Classe responsável por escanear o input do tipo file
 *
 * @package Commbox\Core\Scanner
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Scanner;

use Commbox\Core\Scanner\AbstractScanner;
use Commbox\Core\Helper\UploadFile;

class File extends AbstractScanner
{
    /**
     * @see Commbox\Core\Scanner\AbstractScanner::validate
     */
    protected function validate()
    {
        if (!isset($_FILES) || !isset($_FILES['letterInFile'])) {
            return false;
        }

        return true;
    }

    /**
     * @see Commbox\Core\Scanner\AbstractScanner::getContent
     */
    protected function getContent()
    {
        /**
         * @TODO remover esta dependencia, diminuir o acoplamento
         */
        $uploadFile = new UploadFile();

        $nameFile       = $_FILES['letterInFile']['name'];
        $pathTempFile   = $_FILES['letterInFile']['tmp_name'];

        $uploadFile->save($pathTempFile, $nameFile);

        $pathNewFile    = $uploadFile->mountPath($nameFile);
        $contentFile    = file_get_contents($pathNewFile);

        $uploadFile->delete($nameFile);

        return $contentFile;
    }
}
