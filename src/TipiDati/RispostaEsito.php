<?php
/**
 * Classe che rappresenta il tipo dati RispostaEsito
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica\TipiDati;

class RispostaEsito
{
    /**
    * string Stato File. Può assumere uno dei seguenti valori:
    * SF01 = In elaborazione
    * SF02 = Elaborato
    * SF03 = Errore
    */
    private $Esito;

    /**
    * TipiDati\Notifica Allegato contenente il file messaggi convertito in base64Binary
    */
    private $Notifica;

    /**
    * TipiDati\DettaglioArchivio Nome del file e Identificativo assegnato dal Sistema Ricevente al file trasmesso
    */
    private $DettaglioArchivio;

    /**
    * Eventuale errore di trasmissione riscontrato. Può assumere uno dei seguenti valori:
    *   EI01 = servizio momentaneamente non disponibile
    *   EI02 = utente non abilitato
    */
    private $Errore;

    /**
     * Costruttore
     * @param int $NomeFile
     * @param int $IDFile
     */
    public function __construct(string $Esito, Notifica $Notifica, DettaglioArchivio $DettaglioArchivio, string $Errore)
    {
        $this->Esito = $Esito;
        $this->Notifica = $Notifica;
        $this->DettaglioArchivio = $DettaglioArchivio;
        $this->Errore = $Errore;
    }
}
