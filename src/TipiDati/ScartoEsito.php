<?php
/**
 * Classe che rappresenta il tipo dati ScartoEsito
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class ScartoEsito
{
    /**
    * string contiene il nome del file presente nella proprietà File
    */
    private $NomeFile;

    /**
    * string  il file messaggi convertito in base64Binary, conforme allo schema xsd della “Notifica di Scarto Esito Committente”. L’allegato è presente solo se l’Esito assume valore ES00
    */
    private $File;

    /**
     * Costruttore
     * @param string $NomeFile
     * @param string $File
     */
    public function __construct(string $NomeFile, string $File)
    {
        $this->NomeFile = $NomeFile;
        $this->File = $File;
    }
}
