<?php
/**
 * Classe che rappresenta il tipo dati RispostaSdINotificaEsito
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class RispostaSdINotificaEsito extends RispostaConEsito
{
    /**
    * PHPCraft\FatturazioneElettronica\TipiDati\ScartoEsito
    */
    private $ScartoEsito;

    /**
     * Costruttore
     * @param string $Esito: esito della ricezione. Può assumere uno dei seguenti valori:
     *                                                              ES00 = notifica non accettata
     *                                                              ES01 = notifica accettata
     *                                                              ES02 = servizio non disponibile
     * @param string $NomeFile
     * @param string $File
     */
    public function __construct(string $Esito, string $NomeFile, string $File)
    {
        $this->Esito = $Esito;
        $this->ScartoEsito = new ScartoEsito($NomeFile, $File);
    }
}
