<?php
/**
 * Crea il SOAP client per il webservice TrasmissioneFatture
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ClientSOAP;

class TrasmissioneFatture extends \PHPCraft\FatturazioneElettronica\ClientSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'TrasmissioneFatture_v1.1';

    /**
     * Verifica la correttezza degli argomenti passati con la chiamata all'operazione
     * @param string $operazione
     * @param array $argomenti
     */
    public function verificaArgomenti($operazione, $argomenti)
    {
        switch($operazione) {
            case 'RicevutaConsegna':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\RicevutaConsegna'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'NotificaMancataConsegna':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\NotificaMancataConsegna'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'NotificaScarto':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\NotificaScarto'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'NotificaEsito':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\NotificaEsito'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'NotificaDecorrenzaTermini':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\NotificaDecorrenzaTermini'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
            case 'AttestazioneTrasmissioneFattura':
                $tipiCorretti = ['PHPCraft\FatturazioneElettronica\TipiDati\AttestazioneTrasmissioneFattura'];
                $argomentiSonoCorretti = get_class($argomenti[0]) == $tipiCorretti[0];
            break;
        }
        if(!$argomentiSonoCorretti) {
            throw new \Exception(sprintf('gli argomenti dell\'operazione %s devono essere di tipo: %s', $operazione, implode(', ', $tipiCorretti)));
        }
    }
}
