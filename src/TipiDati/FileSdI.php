<?php
/**
 * Classe che rappresenta il tipo dati FileSdI
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class FileSdI extends FileSdIAccoglienza
{
    /**
    * int Identificativo assegnato al file da SdI
    */
    protected $IdentificativoSdI;

    /**
     * Costruttore
     * @param int $IdentificativoSdI
     * @param string $NomeFile
     * @param string $File
     */
    public function __construct(int $IdentificativoSdI, string $NomeFile, string $File)
    {
        $this->IdentificativoSdI = $IdentificativoSdI;
        $this->NomeFile = $NomeFile;
        $this->File = $File;
    }
}
