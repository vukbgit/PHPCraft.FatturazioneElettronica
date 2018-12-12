<?php
/**
 * Crea il SOAP client per il webservice
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ClientSOAP;

class SdITrasmissioneFile extends \PHPCraft\FatturazioneElettronica\ClientSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'SdITrasmissioneFile_v2.0';

    /**
     * Verifica la correttezza degli argomenti passati con la chiamata all'operazione
     * @param string $operazione
     * @param array $argomenti
     */
    public function verificaArgomenti($operazione, $argomenti)
    {
        switch($operazione) {
            case 'Trasmetti':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\File'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'Esito':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\Esito'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
        }
        if(!$argomentiSonoCorretti) {
            throw new \Exception(sprintf('gli argomenti dell\'operazione %s devono essere di tipo: %s', $operazione, implode(', ', $tipiCorretti)));
        }
    }
}
