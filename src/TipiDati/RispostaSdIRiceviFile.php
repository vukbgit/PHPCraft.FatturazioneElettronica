<?php
/**
 * Classe che rappresenta il tipo dati RispostaSdIRiceviFile
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class RispostaSdIRiceviFile
{
    /**
    * int Identificativo assegnato al file trasmesso da SdI
    */
    private $IdentificativoSdI;

    /**
    * string Data e Ora della ricezione da parte del SdI
    */
    private $DataOraRicezione;

    /**
    * Eventuale errore di trasmissione riscontrato. Può assumere uno dei seguenti valori:
    *   EI01 = file allegato vuoto
    *   EI02 = servizio momentaneamente non disponibile
    *   EI03 = utente non abilitato
    */
    private $Errore;

    /**
     * Costruttore
     * @param int $IdentificativoSdI
     * @param string $DataOraRicezione
     * @param string $Errore
     */
    public function __construct(int $IdentificativoSdI, string $DataOraRicezione, string $Errore)
    {
        $this->IdentificativoSdI = $IdentificativoSdI;
        $this->DataOraRicezione = $DataOraRicezione;
        $this->Errore = $Errore;
    }
}
