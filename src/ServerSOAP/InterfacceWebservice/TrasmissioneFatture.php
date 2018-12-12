<?php
/**
 * Interfaccia che deve essere imlementata dalla classe che gestisce le operazioni dei webservice TrasmissioneFatture
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice;

interface TrasmissioneFatture
{
    /**
     * Operazione TrasmissioneFatture -> RicevutaConsegna
     * @param array $ricevutaConsegna, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function RicevutaConsegna($ricevutaConsegna);

    /**
     * Operazione TrasmissioneFatture -> NotificaMancataConsegna
     * @param array $notificaMancataConsegna, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function NotificaMancataConsegna($notificaMancataConsegna);

    /**
     * Operazione TrasmissioneFatture -> NotificaScarto
     * @param array $notificaScarto, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function NotificaScarto($notificaScarto);

    /**
     * Operazione TrasmissioneFatture -> NotificaEsito
     * @param array $notificaEsito, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function NotificaEsito($notificaEsito);

    /**
     * Operazione TrasmissioneFatture -> NotificaDecorrenzaTermini
     * @param array $notificaDecorrenzaTermini, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function NotificaDecorrenzaTermini($notificaDecorrenzaTermini);

    /**
     * Operazione TrasmissioneFatture -> AttestazioneTrasmissioneFattura
     * @param array $attestazioneTrasmissioneFattura, elementi:
     *              'IdentificativoSdI' => int,
     *              'NomeFile' => string,
     *              'File' => string codificata in base64
     *
     * @return null
     */
    public function AttestazioneTrasmissioneFattura($attestazioneTrasmissioneFattura);
}
