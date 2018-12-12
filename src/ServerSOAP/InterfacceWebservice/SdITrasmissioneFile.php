<?php
/**
 * Interfaccia che deve essere imlementata dalla classe che gestisce le operazioni dei webservice SdITrasmissioneFile
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice;

interface SdITrasmissioneFile
{
    /**
     * Operazione SdITrasmissioneFile -> Trasmetti
     * @param array $file, elementi:
     *              'NomeFile' => string,
     *              'TipoFile' => string,
     *              'File' => string codificata in base64
     *
     * @return \PHPCraft\FatturazioneElettronica\TipiDati\RispostaFile
     */
    public function Trasmetti($file);

    /**
     * Operazione SdITrasmissioneFile -> Esito
     * @param array $esito, elementi:
     *              'IDFile' => int
     *
     * @return \PHPCraft\FatturazioneElettronica\TipiDati\RispostaEsito
     */
    public function Esito($esito);
}
