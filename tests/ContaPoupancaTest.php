<?php

namespace Tests\Conta;

use Classes\Conta;

/**
 * Testes unitários da classe ContaPoupanca
 */
class ContaPoupancaTest extends \PHPUnit_Framework_TestCase {
    public function testeDeposito() {
        $conta = new Conta\ContaPoupanca( 10, 500 );

        $resultado = $conta->deposito( 1000 );

        $this->assertTrue( $resultado['operacao'] );
        $this->assertEquals( 1500, $conta->getSaldo() );
    }

    public function testeSaque() {
        $conta = new Conta\ContaPoupanca( 10, 900 );

        $resultado = $conta->saque( 1000 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 900, $conta->getSaldo() );


        $resultado = $conta->saque( 899.5 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 900, $conta->getSaldo() );


        $resultado = $conta->saque( 500 );

        $this->assertTrue( $resultado['operacao'] );
        $this->assertEquals( 399.2, $conta->getSaldo() );


        $conta->deposito( 1000 );
        $resultado = $conta->saque( 501 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 1399.2, $conta->getSaldo() );
    }

    public function testeTransferencia() {
        $conta = new Conta\ContaPoupanca( 10, 500 );

        $resultado = $conta->transferencia( 200, 12 );

        $this->assertTrue( $resultado['operacao'] );
        $this->assertEquals( 300, $conta->getSaldo() );


        $resultado = $conta->transferencia( 400, 9 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 300, $conta->getSaldo() );
    }
}
