<?php
/**
 * Crea il SOAP client per il webservice RicezioneFatture
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ClientSOAP;

class RicezioneFatture extends \PHPCraft\FatturazioneElettronica\ClientSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'RicezioneFatture_v1.0';

    /**
     * Verifica la correttezza degli argomenti passati con la chiamata all'operazione
     * @param string $operazione
     * @param array $argomenti
     */
    public function verificaArgomenti($operazione, $argomenti)
    {
        switch($operazione) {
            case 'RiceviFatture':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\FileSdIConMetadati'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'NotificaDecorrenzaTermini':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\FileSdI'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
        }
        if(!$argomentiSonoCorretti) {
            throw new \Exception(sprintf('gli argomenti dell\'operazione %s devono essere di tipo: %s', $operazione, implode(', ', $tipiCorretti)));
        }
    }
}
