<?php
/**
 * Classe che rappresenta il tipo dati FileSdIAccoglienza
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class FileSdIAccoglienza
{
    /**
    * string NomeFile Nome file da ricevere
    */
    private $NomeFile;

    /**
    * Allegato contenente il file fattura, ovvero il file archivio, convertito in base64Binary conforme allo schema xsd della Fattura
    */
    private $File;

    /**
     * Costruttore
     * @param int $IdentificativoSdI
     * @param int $NomeFile
     * @param int $File
     */
    public function __construct(string $NomeFile, string $File)
    {
        $this->NomeFile = $NomeFile;
        $this->File = $File;
    }
}
