<?php
/**
 * Interfaccia che deve essere imlementata dalla classe che gestisce le operazioni dei webservice SdIRiceviFile
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice;

interface SdIRiceviFile
{
    /**
     * Operazione SdIRiceviFile -> RiceviFile
     * @param array $fileSdIAccoglienza, elementi:
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return \PHPCraft\FatturazioneElettronica\TipiDati\RispostaSdIRiceviFile
     */
    public function RiceviFile($fileSdIAccoglienza);
}
