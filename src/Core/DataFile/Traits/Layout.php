<?php

/**
 * Trait que define o layout do arquivo
 *
 * @package Commbox\Core\DataFile\Traits
 *
 * @author Rodrigo Conceição de Araujo <omb.rodrigo@gmail.com>
 */
namespace Commbox\Core\DataFile\Traits;

trait Layout
{
    /**
     * Atributo que define o tamanho maximo de uma linha
     *
     * @access protected
     *
     * @var Integer
     */
    protected $lineSize = 300;

    /**
     * Atributo que mantem as definições de "Id"
     *
     * @access protected
     *
     * @var Array
     */
    protected $id = array(
        'start' => 0,
        'size' => 8
    );

    /**
     * Atributo que mantem as definições de "Nome"
     *
     * @access protected
     *
     * @var Array
     */
    protected $nome = array(
        'start' => 8,
        'size' => 64
    );

    /**
     * Atributo que mantem as definições de "Senha"
     *
     * @access protected
     *
     * @var Array
     */
    protected $senha = array(
        'start' => 72,
        'size' => 8
    );

    /**
     * Atributo que mantem as definições de "Data de Nascimento"
     *
     * @access protected
     *
     * @var Array
     */
    protected $dataNascimento = array(
        'start' => 80,
        'size' => 10
    );

    /**
     * Atributo que mantem as definições de "Cidade"
     *
     * @access protected
     *
     * @var Array
     */
    protected $cidade = array(
        'start' => 90,
        'size' => 32
    );

    /**
     * Atributo que mantem as definições de "CPF"
     *
     * @access protected
     *
     * @var Array
     */
    protected $cpf = array(
        'start' => 122,
        'size' => 14
    );

    /**
     * Atributo que mantem as definições de "pai"
     *
     * @access protected
     *
     * @var Array
     */
    protected $pai = array(
        'start' => 136,
        'size' => 64
    );

    /**
     * Atributo que mantem as definições de "mae"
     *
     * @access protected
     *
     * @var Array
     */
    protected $mae = array(
        'start' => 200,
        'size' => 64
    );

    /**
     * Atributo que mantem as definições de "observacao"
     *
     * @access protected
     *
     * @var Array
     */
    protected $observacao = array(
        'start' => 264,
        'size' => 36
    );
}
