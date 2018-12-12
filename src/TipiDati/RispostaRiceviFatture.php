<?php
/**
 * Classe che rappresenta il tipo dati RispostaRiceviFatture
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class RispostaRiceviFatture extends RispostaConEsito
{
    /**
     * Costruttore
     * @param string $Esito: esito della ricezione. Può assumere uno dei seguenti valori: ER01 = presa in carico
     */
    public function __construct(string $Esito)
    {
        $this->Esito = $Esito;
    }
}
