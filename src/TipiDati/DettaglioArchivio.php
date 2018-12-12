<?php
/**
 * Classe che rappresenta il tipo dati DettaglioArchivio
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class DettaglioArchivio
{
    /**
    * string Nome file
    */
    private $NomeFile;

    /**
    * int Identificativo assegnato dal Sistema Ricevente al file trasmesso
    */
    private $IDFile;

    /**
     * Costruttore
     * @param int $NomeFile
     * @param int $IDFile
     */
    public function __construct(string $NomeFile, string $IDFile)
    {
        $this->NomeFile = $NomeFile;
        $this->IDFile = $IDFile;
    }
}
