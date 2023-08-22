<?php

// Interface Observer
interface Observer {
    public function update(string $fabricante, string $nome_vacina, int $dose);
}

// Classe MenuObserver
class MenuObserver implements Observer {
    public function update(string $fabricante, string $nome_vacina, int $dose) {
        // Atualiza o menu com as últimas vacinas registradas
        echo "<div class='quadrado'>Ultimas vacinas registradas/tomadas </div>";
        echo "<p class='item-nixo'>Fabricante: $fabricante</p>";
        echo "<p class='item-nixo'>Nome da Vacina: $nome_vacina</p>";
        echo "<p class='item-nixo'>Dose: $dose</p></div>";
    }
}

?>