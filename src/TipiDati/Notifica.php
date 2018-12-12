<?php
/**
 * Classe che rappresenta il tipo dati Notifica
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class Notifica
{
    /**
    * string NomeFile Nome file da ricevere
    */
    private $NomeFile;

    /**
    * Allegato contenente il file messagio convertito in base64Binary
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
