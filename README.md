# PHPCraft Fatturazione Elettronica #

Libreria per interfacciarsi al Sistema di Interscambio Italiano al fine di gestire la fatturazione elettronica.

__NOTA__: la libreria è in corso di sviluppo e non ancora utilizzabile al momento

__NOTA__: per interfacciarsi realmente a SdI è necesario essere un [soggetto accreditato](https://sdi.fatturapa.gov.it/SdI2FatturaPAWeb/AccediAlServizioAction.do?pagina=accreditamento_canale)

## webservice ##

Questa libreria mira a fornire le funzionalità necessario all'[intermediario](https://www.fatturapa.gov.it/export/fatturazione/it/c-3.htm) per inviare e ricevere fatture elettroniche al/dal SdI, e cioè:

* esporre i webservice SOAP __RicezioneFatture__ e __TrasmissioneFatture__
* connettersi tramite client SOAP ai webservice del ministero __SdIRiceviFile__ e __SdIRiceviNotifica__

Ai fini di permettere di effettuare test prima di interfacciarsi con SdI, la libreria offre anche le funzionalità inverse e cioè:

* esporre i webservice SOAP __SdIRiceviFile__ e __SdIRiceviNotifica__ in modo da potersi connettere tramite il client SOAP generati dalla libreria stessa
* connettersi tramite client SOAP ai webservice __RicezioneFatture__ e __TrasmissioneFatture__ esposti dalla libreria stessa

## XML fattura ##

La libreria contiene anche le classi necessarie a generare e fare il parsing della fattura XML

[Documentazione SdI](https://www.fatturapa.gov.it/export/fatturazione/it/normativa/f-3.htm)
