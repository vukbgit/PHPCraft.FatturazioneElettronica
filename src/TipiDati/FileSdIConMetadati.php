<?php
/**
 * Classe che rappresenta il tipo dati fileSdIConMetadati
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class FileSdIConMetadati extends FileSdI
{
    /**
    * string Nome del file dei metadati relativo al file fattura da ricevere
    */
    private $NomeFileMetadati;

    /**
    * string Allegato contenente il file dei metadati, convertito in base64Binary, conforme allo schema xsd della “Notifica metadati del file fattura al destinatario
    */
    private $Metadati;

    /**
     * Costruttore
     * @param int $IdentificativoSdI
     * @param int $NomeFile
     * @param int $File
     * @param int $NomeFileMetadati
     * @param int $Metadati
     */
    public function __construct(int $IdentificativoSdI, string $NomeFile, string $File, string $NomeFileMetadati, string $Metadati)
    {
        $this->IdentificativoSdI = $IdentificativoSdI;
        $this->NomeFile = $NomeFile;
        $this->File = $File;
        $this->NomeFileMetadati = $NomeFileMetadati;
        $this->Metadati = $Metadati;
    }
}
