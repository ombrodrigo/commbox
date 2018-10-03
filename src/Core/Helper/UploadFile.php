<?php

/**
 * Classe responsável por manter as funcionalidades de upload de arquivo
 *
 * @package Commbox\Core\Helper
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\Helper;

class UploadFile
{
    /**
     * Constante que define o nome da pasta onde serão armazenados os arquivos
     */
    const UPLOAD_PATH = 'public/uploads';

    /**
     * Método responsável por montar o caminho do arquivo
     *
     * @access public
     *
     * @param String $nomeArquivo nome do arquivo para o qual será criado o caminho
     *
     * @return String
     */
    public function mountPath($nomeArquivo)
    {
        return sprintf('%s/%s', self::UPLOAD_PATH, $nomeArquivo);
    }

    /**
     * Método responsável por armazenar um arquivo
     *
     * @access public
     *
     * @param String    $from       caminho do arquivo origem
     * @param String    $nameFile   nome do arquivo
     *
     * @return  Boolean true    arquivo armazenado com sucesso
     *          Boolean false   erro ao armazenar o arquivo
     */
    public function save($from, $nameFile)
    {
        $to = $this->mountPath($nameFile);

        // caso não seja uma ação via POST, copia o arquivo e finaliza o processo
        if (is_uploaded_file($from) === false) {
            return copy($from, $to);
        }

        return move_uploaded_file($from, $to);
    }

    /**
     * Método responsável por remover um arquivo
     *
     * @access public
     *
     * @param String    $nameFile    nome do arquivo
     *
     * @return Boolean
     */
    public function delete($nameFile)
    {
        return unlink($this->mountPath($nameFile));
    }
}
