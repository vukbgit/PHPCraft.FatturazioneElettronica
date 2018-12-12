<?php
/**
 * Classe che rappresenta il tipo dati Esito
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class Esito
{
    /**
    * int Identificativo assegnato dal Sistema Ricevente al file trasmesso
    */
    private $IDFile;

    /**
     * Costruttore
     * @param int $IDFile
     */
    public function __construct(int $IDFile)
    {
        $this->IDFile = $IDFile;
    }
}
