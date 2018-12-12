# PHPCraft Fatturazione Elettronica #

Libreria per interfacciarsi al Sistema di Interscambio Italiano al fine di gestire la fatturazione elettronica.

__NOTA__: la libreria è in corso di sviluppo e non ancora utilizzabile al momento

__NOTA__: per interfacciarsi realmente a SdI è necesario essere un [soggetto accreditato](https://sdi.fatturapa.gov.it/SdI2FatturaPAWeb/AccediAlServizioAction.do?pagina=accreditamento_canale)

## Webservice ##

Questa libreria mira a fornire le funzionalità necessario all'[intermediario](https://www.fatturapa.gov.it/export/fatturazione/it/c-3.htm) per inviare e ricevere fatture elettroniche al/dal SdI, e cioè:

* esporre i webservice SOAP __RicezioneFatture__ e __TrasmissioneFatture__
* connettersi tramite client SOAP ai webservice del ministero __SdIRiceviFile__ e __SdIRiceviNotifica__

Ai fini di permettere di effettuare test prima di interfacciarsi con SdI, la libreria offre anche le funzionalità inverse e cioè:

* esporre i webservice SOAP __SdIRiceviFile__ e __SdIRiceviNotifica__ in modo da potersi connettere tramite il client SOAP generati dalla libreria stessa
* connettersi tramite client SOAP ai webservice __RicezioneFatture__ e __TrasmissioneFatture__ esposti dalla libreria stessa

Ecco lo schema completo dei webservices e delle relative operazioni:

* Servizio SdICoop RICEZIONE:
    * ws RicezioneFatture (esposto dall'intermediario):
        * op. RiceviFatture
        * op. NotificaDecorrenzaTermini
    * ws SdIRiceviNotifica (esposto dal SdI):
        * op. NotificaEsito
* Servizio SdICoop TRASMISSIONE:
    * ws SdIRiceviFile (esposto dal SdI):
        * op. RiceviFile
    * ws TrasmissioneFatture (esposto dall'intermediario):
        * op. RicevutaConsegna
        * op. NotificaMancataConsegna
        * op. NotificaScarto
        * op. NotificaEsito
        * op. NotificaDecorrenzaTermini
        * op. AttestazioneTrasmissioneFattura
* Servizio SDIDati:
    * ws SdITrasmissioneFile:
        * op. Trasmetti
        * op. Esito


## XML fattura ##

La libreria contiene anche le classi necessarie a generare e fare il parsing della fattura XML

## Utilizzo ##

### creazione webservice ###

PEr ogni webservice che si vuole esporre è necessario utilizzare una classe che implementi l'interfaccia corrispondente al webservice fra quelle contenute in \PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice e che quindi esponga tutti i metodi corrispondenti alle varie operazioni del webservice, per esempio:

    class MiaClassePerWebserviceRicezioneFatture implements \PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice\RicezioneFatture
    {
        public function RiceviFatture($fileSdIConMetadati)
        {
            //eseguo le operazioni necessarie per l'operazione RiceviFatture
            ....
            //Ritorno l'oggetto corretto per la risposta
            return new \PHPCraft\FatturazioneElettronica\TipiDati\RispostaRiceviFatture('ER01');
        }

        public function NotificaDecorrenzaTermini($fileSdI)
        {
            //eseguo le operazioni necessarie per l'operazione NotificaDecorrenzaTermini
            ...
            //Ritorno nullo per questa operazione
            return null;
        }
    }

Posso quindi creare l'istanza del webservice:

    //istanziare SOAP server Zend, il wsdl e le opzioni SOAP vengono impostate successivamente
    $zendSOAPServer = new Zend\Soap\Server;
    //istanziare la classe appropriata al server SOAP che si intende esporre fra RicezioneFatture, TrasmissioneFatture, SdIRiceviFile e SdIRiceviNotifica, per esempio RicezioneFatture
    $server = new \PHPCraft\FatturazioneElettronica\ServerSOAP\RicezioneFatture(
        $opzioniSOAP    //array di opzioni SOAP come accettate dal SOAP server Zend
    );
    //inietta l'istanza del SOAP server Zend
    $server->injectServerSOAP($zendSOAPServer);
    //inietta l'istanze della classe che gestisce le operazioni del webservice
    $miaClassePerWebserviceRicezioneFatture = new MiaClassePerWebserviceRicezioneFatture;
    $server->injectIstanzaGestoreWebservice($miaClassePerWebserviceRicezioneFatture);
    //poni il server SOAP in ascolto
    $server->listen();

### chiamata operazioni tramite client ###

    //istanzia il SOAP client Zend
    $zendSOAPClient = new Zend\Soap\Client;
    //istanzia SOAP client PHPCraft in base al webservice da chiamare, per esempio RicezioneFatture
    $client = new $\PHPCraft\FatturazioneElettronica\ClientSOAP\RicezioneFatture();
    //inietta il SOAP client Zend
    $client->injectClientSOAP($zendSOAPClient);
    //prepara i parametri da utilizzare con l'operazione del webservice che si desidera chiamare, per esempio RiceviFatture
    $fileFattura = base64_encode(file_get_contents('percorso/ad/una/fattura.xml'));
    $fileMetadati = base64_encode(file_get_contents('percorso/ad/un/file/metadati.xml'));
    $fileSdIConMetadati = [
        'IdentificativoSdI' => '123456',
        'NomeFile' => 'nome-del-file-fattura',
        'File' => $fileFattura,
        'NomeFileMetadati' => 'nome-del-file-metadati',
        'Metadati' => $fileMetadati
    ];
    //la classe utilizza i wsdl forniti dal Ministero che contengono l'endpoint su fatturapa.it, se ci si vuole connettere ad un diverso endpoint (per esmpio ai fini di test) bisogna spcificare la location
    $client->setLocation('https://fatturazione-elettronica.miodominio.it/RicezioneFatture');
    //si chiama il metodo del client che ha lo stesso nome dell'operazione che si intende chiamare
    $return = $client->RiceviFatture($fileSdIConMetadati);

[Documentazione SdI](https://www.fatturapa.gov.it/export/fatturazione/it/normativa/f-3.htm)
