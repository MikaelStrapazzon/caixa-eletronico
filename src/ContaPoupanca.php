<?php

namespace Classes\Conta;

/**
 * Classe ContaPoupanca
 */
class ContaPoupanca extends Conta {
    /**
     * Recebe ID e Saldo. Demais valores são fixos de acordo com o tipo de conta
     * @param int $id Identificador da conta
     * @param float $saldo Saldo inicial da conta
     */
    public function __construct( int $id, float $saldo ) {
        $this->id = $id;
        $this->saldo = $saldo;

        $this->limiteSaqueDisponivel = 1000;
        $this->limiteSaque = 1000;
        $this->taxaOperacao = 0.8;
    }
}