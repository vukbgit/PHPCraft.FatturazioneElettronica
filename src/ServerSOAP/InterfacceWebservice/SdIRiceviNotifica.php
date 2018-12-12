<?php
/**
 * Interfaccia che deve essere imlpementata dalla classe che gestisce le operazioni dei webservice SdIRiceviNotifica
 * @author vuk <http://vuk.bg.it>
 */

 namespace PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice;

interface SdIRiceviNotifica
{
    /**
     * Operazione SdIRiceviNotifica -> NotificaEsito
     * @param array $fileSdI, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return \PHPCraft\FatturazioneElettronica\TipiDati\RispostaSdINotificaEsito
     */
    public function NotificaEsito($fileSdI);
}
