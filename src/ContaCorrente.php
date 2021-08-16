<?php

namespace Classes\Conta;

/**
 * Classe ContaCorrente
 */
class ContaCorrente extends Conta {
    /**
     * Recebe ID e Saldo. Demais valores são fixos de acordo com o tipo de conta
     * @param int $id Identificador da conta
     * @param float $saldo Saldo inicial da conta
     */
    public function __construct( int $id, float $saldo ) {
        $this->id = $id;
        $this->saldo = $saldo;

        $this->limiteSaqueDisponivel = 600;
        $this->limiteSaque = 600;
        $this->taxaOperacao = 2.5;
    }
}