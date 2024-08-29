<?php

declare(strict_types=1);

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
  #[DataProvider('leilaoEmOrdemCrescente')]
  #[DataProvider('leilaoEmOrdemDecrescente')]
  #[DataProvider('leilaoEmOrdemAleatoria')]
  public function testAvaliadorDeveEncontrarOMaiorValor(Leilao $leilao)
  {
    // Arrange - Given
    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $maiorValor = $leiloeiro->getMaiorValor();

    // Assert - Then
    $valorEsperado = 5000;
    self::assertEquals($valorEsperado, $maiorValor);
  }

  #[DataProvider('leilaoEmOrdemCrescente')]
  #[DataProvider('leilaoEmOrdemDecrescente')]
  #[DataProvider('leilaoEmOrdemAleatoria')]
  public function testAvaliadorDeveEncontrarOMenorValor(Leilao $leilao)
  {
    // Arrange - Given
    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $menorValor = $leiloeiro->getMenorValor();

    // Assert - Then
    $valorEsperado = 2000;
    self::assertEquals($valorEsperado, $menorValor);
  }

  #[DataProvider('leilaoEmOrdemCrescente')]
  #[DataProvider('leilaoEmOrdemDecrescente')]
  #[DataProvider('leilaoEmOrdemAleatoria')]
  public function testAvaliadorDeveBuscarOsTresMaioresLances(Leilao $leilao)
  {
    // Arrange - Given
    $leiloeiro = new Avaliador();

    // Act - When
    $leiloeiro->avalia($leilao);

    $maioresLances = $leiloeiro->getMaioresLances();

    // Assert - Then
    self::assertCount(3, $maioresLances);
    self::assertEquals(5000, $maioresLances[0]->getValor());
    self::assertEquals(4000, $maioresLances[1]->getValor());
    self::assertEquals(3000, $maioresLances[2]->getValor());
  }

  public static function leilaoEmOrdemCrescente(): array
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');
    $ana = new Usuario('Ana');
    $jorge = new Usuario('Jorge');

    $leilao->recebeLance(new Lance($maria, 2000));
    $leilao->recebeLance(new Lance($joao, 3000));
    $leilao->recebeLance(new Lance($ana, 4000));
    $leilao->recebeLance(new Lance($jorge, 5000));

    return ['leilao em ordem crescente' => [$leilao]];
  }

  public static function leilaoEmOrdemDecrescente(): array
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');
    $ana = new Usuario('Ana');
    $jorge = new Usuario('Jorge');

    $leilao->recebeLance(new Lance($jorge, 5000));
    $leilao->recebeLance(new Lance($maria, 4000));
    $leilao->recebeLance(new Lance($joao, 3000));
    $leilao->recebeLance(new Lance($ana, 2000));

    return ['leilao em ordem decrescente' => [$leilao]];
  }

  public static function leilaoEmOrdemAleatoria(): array
  {
    // Arrange - Given
    $leilao = new Leilao('Fiat 147 0KM');

    $maria = new Usuario('Maria');
    $joao = new Usuario('João');
    $ana = new Usuario('Ana');
    $jorge = new Usuario('Jorge');

    $leilao->recebeLance(new Lance($joao, 3000));
    $leilao->recebeLance(new Lance($maria, 2000));
    $leilao->recebeLance(new Lance($jorge, 5000));
    $leilao->recebeLance(new Lance($ana, 4000));

    return ['leilao em ordem aleatoria' => [$leilao]];
  }
}
