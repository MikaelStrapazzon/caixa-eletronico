<?php

namespace Tests\Conta;

use Classes\Conta;

/**
 * Testes unitários da classe ContaCorrente
 */
class ContaCorrente extends \PHPUnit_Framework_TestCase {
    public function testeDeposito() {
        $conta = new Conta\ContaCorrente( 10, 500 );

        $resultado = $conta->deposito( 1000 );

        $this->assertTrue( $resultado['operacao'] );
        $this->assertEquals( 1500, $conta->getSaldo() );
    }

    public function testeSaque() {
        $conta = new Conta\ContaCorrente( 10, 500 );

        $resultado = $conta->saque( 601 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 500, $conta->getSaldo() );


        $resultado = $conta->saque( 499 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 500, $conta->getSaldo() );


        $resultado = $conta->saque( 400 );

        $this->assertTrue( $resultado['operacao'] );
        $this->assertEquals( 97.5, $conta->getSaldo() );


        $conta->deposito( 1000 );
        $resultado = $conta->saque( 201 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 1097.5, $conta->getSaldo() );
    }

    public function testeTransferencia() {
        $conta = new Conta\ContaCorrente( 10, 500 );

        $resultado = $conta->transferencia( 200, 12 );

        $this->assertTrue( $resultado['operacao'] );
        $this->assertEquals( 300, $conta->getSaldo() );


        $resultado = $conta->transferencia( 400, 9 );

        $this->assertFalse( $resultado['operacao'] );
        $this->assertEquals( 300, $conta->getSaldo() );
    }
}
