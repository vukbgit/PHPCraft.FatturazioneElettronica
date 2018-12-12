<?php
/**
 * Classe che rappresenta il tipo dati RispostaFile
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class RispostaFile
{
    /**
    * int Identificativo assegnato dal Sistema Ricevente al file trasmesso
    */
    private $IDFile;

    /**
    * string Data e Ora della ricezione da parte del SdI
    */
    private $DataOraRicezione;

    /**
    * Eventuale errore di trasmissione riscontrato. Può assumere uno dei seguenti valori:
    *   EI01 = file allegato vuoto
    *   EI02 = servizio momentaneamente non disponibile
    *   EI03 = utente non abilitato
    *   EI04 =tipo file non corretto
    */
    private $Errore;

    /**
     * Costruttore
     * @param int $IDFile
     * @param string $DataOraRicezione
     * @param string $Errore
     */
    public function __construct(int $IDFile, string $DataOraRicezione, string $Errore)
    {
        $this->IDFile = $IDFile;
        $this->DataOraRicezione = $DataOraRicezione;
        $this->Errore = $Errore;
    }
}
