<?php
/**
 * Crea il SOAP client per il webservice SdIRiceviFile
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ClientSOAP;

class SdIRiceviFile extends \PHPCraft\FatturazioneElettronica\ClientSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'SdIRiceviFile_v1.0';

    /**
     * Verifica la correttezza degli argomenti passati con la chiamata all'operazione
     * @param string $operazione
     * @param array $argomenti
     */
    public function verificaArgomenti($operazione, $argomenti)
    {
        switch($operazione) {
            case 'RiceviFile':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\FileSdIAccoglienza'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
        }
        if(!$argomentiSonoCorretti) {
            throw new \Exception(sprintf('gli argomenti dell\'operazione %s devono essere di tipo: %s', $operazione, implode(', ', $tipiCorretti)));
        }
    }
}
