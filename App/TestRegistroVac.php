<?php
require_once "Back-End/config.php";
require_once "padrao_projeto/Observer.php";
require_once "Back-End/func-menulogin.php";

use PHPUnit\Framework\TestCase;

class TestRegistroVac extends TestCase
{

    public function testPadraoObservador()
    {
        // Criar instância do observador
        $menuObserver = new MenuObserver();

        // Criar instância do observável
        $registroVacinaObservable = new RegistroVacinaObservable();

        // Adicionar observador ao observável
        $registroVacinaObservable->addObserver($menuObserver);

        // Simular dados de exemplo
        $fabricante = "TesteFabricante";
        $nome_vacina = "TesteNomeVacina";
        $dose = 2;

        // Chamar diretamente o método de notificação
        $registroVacinaObservable->notifyObservers($fabricante, $nome_vacina, $dose);

        // Verificar se o observador recebeu os dados corretos
        $this->assertEquals([$fabricante, $nome_vacina, $dose], $menuObserver->getData());
    }
   
}