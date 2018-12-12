<?php
/**
 * Crea il SOAP server SdITrasmissioneFile che "consente al trasmittente, tramite un canale di cooperazione applicativa, di:
 * - inviare al Sistema Ricevente un file o un file archivio;
 * - recuperare dal Sistema Ricevente i messaggi relativi ai file trasmessi." (dalla documentazione ufficiale SdI)
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP;

class SdITrasmissioneFile extends \PHPCraft\FatturazioneElettronica\ServerSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'SdITrasmissioneFile_v2.0';
}
