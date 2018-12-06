<?php
/**
 * Crea il SOAP server RicezioneFatture che "esposto dal destinatario, si occupa della ricezione dei
 * file fattura inviati dal SdI, tenendo conto dei diversi formati di trasmissione (FPR12, FPA12, FSM10) ;" (dalla documentazione ufficiale SdI)
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP;

class TrasmissioneFatture extends \PHPCraft\FatturazioneElettronica\ServerSOAP
{
    /**
    * Nome del file wsdl (senza estensione .wsdl)
    **/
    protected $nomeWsdl = 'TrasmissioneFatture_v1.1';
}
