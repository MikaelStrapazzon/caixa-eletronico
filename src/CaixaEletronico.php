<?php

namespace Classes;

/**
 * Classe CaixaEletronico
 * Recebe uma conta e realiza operações bancárias nela
 */
class CaixaEletronico {
    private $conta;

    /**
     * Recebe a conta bancária que será realizado as operações
     * @param Conta $conta Conta que vai ser realizado as operações
     */
    public function __construct( $conta ) {
        $this->conta = $conta;
    }

    /**
     * Realizado um deposito na conta bancária
     * @param float $valorDepositado Valor que será depositado
     * @return array
     *  bool operacao: Indica se foi realizado com sucesso a operação
     *  string msg: Mensagem de erro/sucesso
     */
    public function deposito( float $valorDepositado ) {
        return $this->conta->deposito( $valorDepositado );
    }

    /**
     * Realizado um saque na conta bancária
     * @param float $valorSaque Valor que será sacado
     * @return array
     *  bool operacao: Indica se foi realizado com sucesso a operação
     *  string msg: Mensagem de erro/sucesso
     */
    public function saque( float $valorSaque ) {
        return $this->conta->saque( $valorSaque );
    }

    /**
     * Realizado um Transferência entre contas bancárias
     * @param float $valorTransferencia Valor que será transferido
     * @param int $idContaDestino Identificador da conta que receberá a transferência
     * @return array
     *  bool operacao: Indica se foi realizado com sucesso a operação
     *  string msg: Mensagem de erro/sucesso
     */
    public function transferencia( float $valorTransferencia, int $idContaDestino ) {
        return $this->conta->transferencia( $valorTransferencia, $idContaDestino );
    }
}