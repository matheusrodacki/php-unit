<?php

declare(strict_types=1);

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
  public function testeAvaliadorDeveEncontrarOMaiorValorEmOrdemCrescente()
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');

    $leilao->recebeLance(new Lance($joao, 2000));
    $leilao->recebeLance(new Lance($maria, 2500));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $maiorValor = $leiloeiro->getMaiorValor();

    // Assert - Then
    $valorEsperado = 2500;
    self::assertEquals($valorEsperado, $maiorValor);
  }

  public function testeAvaliadorDeveEncontrarOMaiorValorEmOrdemDecrescente()
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');

    $leilao->recebeLance(new Lance($maria, 2500));
    $leilao->recebeLance(new Lance($joao, 2000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $maiorValor = $leiloeiro->getMaiorValor();

    // Assert - Then
    $valorEsperado = 2500;
    self::assertEquals($valorEsperado, $maiorValor);
  }

  public function testeAvaliadorDeveEncontrarOMaiorValorEmOrdemAleatoria()
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');

    $leilao->recebeLance(new Lance($maria, 2500));
    $leilao->recebeLance(new Lance($joao, 3000));
    $leilao->recebeLance(new Lance($maria, 2000));
    $leilao->recebeLance(new Lance($joao, 4000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $maiorValor = $leiloeiro->getMaiorValor();

    // Assert - Then
    $valorEsperado = 4000;
    self::assertEquals($valorEsperado, $maiorValor);
  }

  public function testeAvaliadorDeveEncontrarOMenorValorEmOrdemCrescente()
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');

    $leilao->recebeLance(new Lance($maria, 500));
    $leilao->recebeLance(new Lance($joao, 1000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then
    $valorEsperado = 500;
    self::assertEquals($valorEsperado, $menorValor);
  }

  public function testeAvaliadorDeveEncontrarOMenorValorEmOrdemDecrescente()
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');

    $leilao->recebeLance(new Lance($joao, 1000));
    $leilao->recebeLance(new Lance($maria, 500));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then
    $valorEsperado = 500;
    self::assertEquals($valorEsperado, $menorValor);
  }

  public function testeAvaliadorDeveEncontrarOMenorValorEmOrdemAleatoria()
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');

    $leilao->recebeLance(new Lance($maria, 4000));
    $leilao->recebeLance(new Lance($joao, 3000));
    $leilao->recebeLance(new Lance($maria, 5000));
    $leilao->recebeLance(new Lance($joao, 1000));

    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then
    $valorEsperado = 1000;
    self::assertEquals($valorEsperado, $menorValor);
  }
}
