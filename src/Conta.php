<?php

namespace Classes\Conta;

/**
 * Classe abstract Conta
 * Todas classes dos tipos especificos de conta, derivam dela
 */
abstract class Conta {
    protected int $id;
    protected float $saldo;
    protected float $limiteSaqueDisponivel;

    protected float $limiteSaque;
    protected float $taxaOperacao;

    /**
     * Retorna o saldo da conta
     * @return float Saldo da conta
     */
    public function getSaldo() {
        return $this->saldo;
    }

    /**
     * Realizado um deposito na conta bancária
     * @param float $valorDepositado Valor que será depositado
     * @return array
     *  bool operacao: Indica se foi realizado com sucesso a operação
     *  string msg: Mensagem de erro/sucesso
     */
    public function deposito( float $valorDepositado ) {
        $this->saldo += $valorDepositado;

        return [
            'operacao' => True,
            'msg' => "Deposito de B$ " . $valorDepositado . " realizado com sucesso."
        ];
    }

    /**
     * Realizado um saque na conta bancária
     * @param float $valorSaque Valor que será sacado
     * @return array
     *  bool operacao: Indica se foi realizado com sucesso a operação
     *  string msg: Mensagem de erro/sucesso
     */
    public function saque( float $valorSaque ) {
        $saldo = $this->saldo;

        if( $this->limiteSaque < $valorSaque )
            return [
                'operacao' => False,
                'msg' => "Valor do saque ultrapassa o limite por acesso."
            ];

        if( $this->limiteSaqueDisponivel < $valorSaque )
            return [
                'operacao' => False,
                'msg' => "Valor do saque ultrapassa o limite por acesso disponivel."
            ];

        if( $saldo < $valorSaque )
            return [
                'operacao' => False,
                'msg' => "A conta não possui saldo suficiente."
            ];

        if( $saldo < ( $valorSaque + $this->taxaOperacao ) )
            return [
                'operacao' => False,
                'msg' => "A conta não possui saldo suficiente para o saque mais taxa de operação."
            ];

        $this->saldo -= $valorSaque + $this->taxaOperacao;
        $this->limiteSaqueDisponivel -= $valorSaque;

        return [
            'operacao' => True,
            'msg' => "Saque de B$ " . $valorSaque . " realizado com sucesso."
        ];
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
        if( $this->saldo < $valorTransferencia )
            return [
                'operacao' => False,
                'msg' => "A conta não possui saldo suficiente."
            ];

        $this->saldo -= $valorTransferencia;

        //Necessário algum método de armazenagem das conta para funcionar a "linkagem" da conta por ID
        //Assim sendo possível implementar o recebimento do dinheiro transferido
        //
        //$contaDestino = carregaConta( $idContaDestino );
        //$contaDestino->recebeTransferencia( $valorTransferencia );

        return [
            'operacao' => True,
            'msg' => "Tramsferência de B$ " . $valorTransferencia . " realizado com sucesso para " . $idContaDestino . "."
        ];
    }
}