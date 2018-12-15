<?php
/**
 * Crea il SOAP client per il webservice SdIRiceviNotifica
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ClientSOAP;

class SdIRiceviNotifica extends \PHPCraft\FatturazioneElettronica\ClientSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'SdIRiceviNotifica_v1.0';

    /**
    * Location di test e produzione
    **/
    protected $locations = [
        'test' => ' https://testservizi.fatturapa.it/ricevi_notifica
',
        'produzione' => 'https://servizi.fatturapa.it/ricevi_notifica'
    ];

    /**
     * Verifica la correttezza degli argomenti passati con la chiamata all'operazione
     * @param string $operazione
     * @param array $argomenti
     */
    public function verificaArgomenti($operazione, $argomenti)
    {
        switch($operazione) {
            case 'NotificaEsito':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\FileSdI'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
        }
        if(!$argomentiSonoCorretti) {
            throw new \Exception(sprintf('gli argomenti dell\'operazione %s devono essere di tipo: %s', $operazione, implode(', ', $tipiCorretti)));
        }
    }
}
