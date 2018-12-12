<?php
/**
 * Crea il SOAP server SdIRiceviNotifica che " esposto dal SdI per i soli file fatturaPA, si occupa di ricevere la notifica di esito committente e di restituire l’eventuale scarto esito committente." (dalla documentazione ufficiale SdI)
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP;

class SdIRiceviNotifica extends \PHPCraft\FatturazioneElettronica\ServerSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'SdIRiceviNotifica_v1.0';
}
