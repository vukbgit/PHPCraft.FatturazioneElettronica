<?php
/**
 * Classe che rappresenta il tipo dati File
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class File extends FileSdIAccoglienza
{
    /**
    * string Tipo file da Trasmettere i cui valori possibili sono:
    * DF: File o archivio di tipo Dati Fattura
    * LI: File o archivio di tipo Liquidazioni Iva
    * FL: Archivio contenente Dati Fattura e Liquidazioni Iva
    */
    protected $TipoFile;

    /**
     * Costruttore
     * @param string $NomeFile
     * @param string $TipoFile
     * @param string $File
     */
    public function __construct(string $NomeFile, string $TipoFile, string $File)
    {
        $this->NomeFile = $NomeFile;
        $this->TipoFile = $TipoFile;
        $this->File = $File;
    }
}
