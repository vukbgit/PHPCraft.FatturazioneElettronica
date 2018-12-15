<?php
/**
 * Classe parent delle classi dei singoli SOAP server
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica;

abstract class ServerSOAP
{
     use AgenteSOAP;

    /**
    * L'istanza di Zend\Soap\Server
    **/
    private $serverSOAP = null;

    /**
    * L'istanza della classe che espone i metodi corrispondenti alle operazioni a cui verranno passati gli input delle chiamate
    **/
    protected $istanzaGestoreWebservice = null;

    /**
     * Costruttore
     * @param array $opzioniSOAP
     */
    public function __construct($opzioniSOAP = null)
    {
        $this->opzioniSOAP = $opzioniSOAP;
    }

    /**
    * Inietta l'istanza di Zend SOAP server
    * @param \Zend\Soap\Server $serverSOAP
    **/
    public function injectServerSOAP(\Zend\Soap\Server $serverSOAP)
    {
        $this->serverSOAP = $serverSOAP;
        //imposta le opzioni SOAP
        if($this->opzioniSOAP) {
            $this->serverSOAP->setOptions($this->opzioniSOAP);
        }
    }

    /**
    * Inietta l'istanza della classe che espone i metodi corrispondenti alle operazioni a cui verranno passati gli input delle chiamate
    * @param object $istanzaGestoreWebservice
    **/
    public function injectIstanzaGestoreWebservice($istanzaGestoreWebservice)
    {
        $NSClasse = explode('\\', get_class($this));
        $webservice = array_pop($NSClasse);
        $interface = sprintf('PHPCraft\FatturazioneElettronica\ServerSOAP\InterfacceWebservice\%s', $webservice);
        //verifica che implementi l'interfaccia appropriata per il webservice in ascolto
        if(!($istanzaGestoreWebservice instanceof $interface)) {
            throw new \Exception(sprintf('Il gestore del webservice deve implementare l\'interfaccia \%s', $interface));
        }
        $this->istanzaGestoreWebservice = $istanzaGestoreWebservice;
    }

    /**
     * Avvia il webservice
     */
    public function listen()
    {
        //verifica che sia stato iniettato il SOAP Server Zend
        if(!$this->serverSOAP) {
            throw new \Exception('Iniettare un\'istanza di \Zend\Soap\Server tramite il metodo injectServerSOAP');
        }
        //verifica che sia stata iniettatal'istanza del gestore del webservice
        if(!$this->istanzaGestoreWebservice) {
            throw new \Exception('Iniettare un\'istanza del gestore del webservice tramite il metodo injectIstanzaGestoreWebservice');
        }
        //set wsdl
        $this->serverSOAP->setWsdl($this->buildPercorsoWsdl());
        //$this->serverSOAP->setDebugMode(true);
        //bind l'istanza del gestore al SOAP server Zend
        $this->serverSOAP->setObject($this->istanzaGestoreWebservice);
        //resta in ascolto
        $this->serverSOAP->handle();
    }
}
