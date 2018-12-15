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

Per ogni webservice che si vuole esporre è necessario utilizzare una classe che implementi l'interfaccia corrispondente al webservice fra quelle contenute in \PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice e che quindi esponga tutti i metodi corrispondenti alle varie operazioni del webservice, per esempio:

    class MiaClassePerWebserviceRicezioneFatture implements \PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice\RicezioneFatture
    {
        public function RiceviFatture($fileSdIConMetadati)
        {
            //eseguire le operazioni necessarie per l'operazione RiceviFatture
            ....
            //ritornare l'oggetto corretto per la risposta
            return new \PHPCraft\FatturazioneElettronica\TipiDati\RispostaRiceviFatture('ER01');
        }

        public function NotificaDecorrenzaTermini($fileSdI)
        {
            //eseguire le operazioni necessarie per l'operazione NotificaDecorrenzaTermini
            ...
            //ritornare nullo per questa operazione
            return null;
        }
    }

È quindi possibile creare l'istanza del webservice:

    //disabilitare la cache wsdl se si stanno utilizzando dei wsdl non ancora definitivi
    ini_set("soap.wsdl_cache_enabled", "0");
    //istanziare SOAP server Zend, il wsdl e le opzioni SOAP vengono impostate successivamente
    $zendSOAPServer = new Zend\Soap\Server;
    //istanziare la classe appropriata al server SOAP che si intende esporre fra RicezioneFatture, TrasmissioneFatture, SdIRiceviFile e SdIRiceviNotifica, per esempio RicezioneFatture
    $server = new \PHPCraft\FatturazioneElettronica\ServerSOAP\RicezioneFatture(
        $opzioniSOAP    //array di opzioni SOAP come accettate dal SOAP server Zend
    );
    //iniettare l'istanza del SOAP server Zend
    $server->injectServerSOAP($zendSOAPServer);
    //iniettare l'istanze della classe che gestisce le operazioni del webservice
    $miaClassePerWebserviceRicezioneFatture = new MiaClassePerWebserviceRicezioneFatture;
    $server->injectIstanzaGestoreWebservice($miaClassePerWebserviceRicezioneFatture);
    //porre il server SOAP in ascolto
    $server->listen();

### chiamata operazioni tramite client ###

    //disabilitare la cache wsdl se si stanno utilizzando dei wsdl non ancora definitivi
    ini_set("soap.wsdl_cache_enabled", "0");
    //istanziare il client SOAP Zend
    $zendSOAPClient = new Zend\Soap\Client;
    //istanziare il client SOAP PHPCraft in base al webservice da chiamare, per esempio RicezioneFatture
    $client = new $\PHPCraft\FatturazioneElettronica\ClientSOAP\RicezioneFatture();
    //inietta il SOAP client Zend
    $client->injectClientSOAP($zendSOAPClient);
    //impostare location SE diversa da quella ufficiale contenuta nei wsdl, per esempio se si stanno testando i webservice sul proprio dominio
    $client->setLocation('https://fatturazione-elettronica.mio.dominio/nome-webservice');


    //preparare i parametri in input a seconda dell'operazione del webservice che si desidera chiamare, verificandoli nelle interfacce disponibili in \PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice, per esempio per RicezioneFatture -> RiceviFatture
    $fileFattura = base64_encode(file_get_contents('percorso/alla/fattura.xml'));
    $fileMetadati = base64_encode(file_get_contents('percorso/al/file/metadati.xml'));
    $fileSdIConMetadati = new \PHPCraft\FatturazioneElettronica\TipiDati\FileSdIConMetadati(
        123,    //identificatiovo bumerico file
        'nome del file',
        $fileFattura,
        'nome del file metadati',
        $fileMetadati
    );
    //la classe del client espone i metodi con i nomi delle operazioni (in questo caso RiceviFatture)
    $return = $client->RiceviFatture($fileSdIConMetadati);

## certificati ##

Panoramica dei documenti crittografici (chiavi, richieste di certificati, certificati) coinvolti; i blocchi di codice contengono i comandi openssl utilizzati, le frasi in corsivo sono riportate dalla documentazine e dai messaggi forniti dal SdI:

* __chiave privata + pubblica client__: client-private-public.pem
    * `openssl genrsa –out client-private-public.pem 2048`
* __chiave pubblica client__: client-public.pem
    * estratta dalla chiave privata + pubblica con
            openssl rsa -in client-private-public.pem -out client-public.pem -outform PEM -pubout
* __CSR client__: client.csr
        openssl req -new -key client-private-public.pem -out client.csr
    * _per la CSR client è richiesto che nel "cn" (Common Name) della richiesta sia indicato il Codice Fiscale del Sottoscrittore preceduto da 'SDI-' (SDI-03084840168)_
* __chiave privata + pubblica server__: server-private-public.pem
        openssl genrsa –out server-private-public.pem 2048
* __CSR client__: client.csr
        openssl req -new -key server-private-public.pem -out server.csr
    * _per la CSR server si può scegliere se procedere come per la CSR client oppure se inserire all'interno del "cn" l'hostname del server che ospita il servizio_ (inserito hostname).
* __certificati legati alle CSR__: scaricabili da [https://sdi.fatturapa.gov.it](https://sdi.fatturapa.gov.it) in Strumenti > Gestire il canale > Test interoperabilità > Download File dopo aver inviato via pec RichiestaAccreditamento.zip.p7m (la richiesta firmata digitalmente)
    * _i certificati necessari per la configurazione SSL dei propri ambienti, in base alle CSR inviate in fase di accreditamento_
    * __certificato client__: SDI-[codice-fiscale-inserito-nella-CSR-clien].cer
    * __certificato server__: [valore-del-campo-CN-inserito-nella-CSR-server].cer
* __Kit di Test__: scaricabile da [https://sdi.fatturapa.gov.it](https://sdi.fatturapa.gov.it) in Strumenti > Gestire il canale > Test interoperabilità > Download File dopo aver inviato via pec RichiestaAccreditamento.zip.p7m (la richiesta firmata digitalmente)
    * __certificati di CA (Certification Authority)__:
        * caentrate.cer: certificato di CA per ambiente di __produzione__
        * CAEntratetest.cer: certificato di CA per validare il certificato SdI di __test__
    * __CERTIFICATI DI TEST__:
        * testservizi.fatturapa.it.cer: Certificato SERVER esposto dai servizi di test del Sistema di Interscambio
        * SistemaInterscambioFatturaPATest.cer: Parte pubblica del certificato CLIENT utilizzato dal Sistema di Interscambio per invocare i servizi di test da voi esposti
    * __CERTIFICATI DI PRODUZIONE__:
        * servizi.fatturapa.it.cer: Certificato SERVER esposto dai servizi del Sistema di Interscambio
        * SistemaInterscambioFatturaPA.cer: Parte pubblica del certificato CLIENT utilizzato dal Sistema di Interscambio per invocare i servizi da voi esposti


[Documentazione SdI](https://www.fatturapa.gov.it/export/fatturazione/it/normativa/f-3.htm)
