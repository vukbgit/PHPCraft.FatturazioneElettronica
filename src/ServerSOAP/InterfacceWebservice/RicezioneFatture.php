<?php
/**
 * Interfaccia che deve essere imlpementata dalla classe che gestisce le operazioni dei webservice RicezioneFatture
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice;

interface RicezioneFatture
{
    /**
     * Operazione RicezioneFatture -> RiceviFatture
     * @param array $fileSdIConMetadati, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64,
     *              'NomeFileMetadati' => string,
     *              'Metadati' => string codificata in base64
     *
     * @return \PHPCraft\FatturazioneElettronica\TipiDati\RispostaRiceviFatture
     */
    public function RiceviFatture($fileSdIConMetadati);

    /**
     * Operazione RicezioneFatture -> NotificaDecorrenzaTermini
     * @param array $fileSdI, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function NotificaDecorrenzaTermini($fileSdI);
}
