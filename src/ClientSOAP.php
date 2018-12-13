<?php
/**
 * Classe parent delle classi dei singoli SOAP server
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica;

abstract class ClientSOAP extends AgenteSOAP
{
    /**
    * L'istanza di Zend\Soap\Client
    **/
    private $clientSOAP;

    /**
    * Inietta l'istanza di Zend SOAP client
    * @param \Zend\Soap\Client $clientSOAP
    **/
    /*public function injectClientSOAP(\Zend\Soap\Client $clientSOAP)
    {
        $this->clientSOAP = $clientSOAP;
        //imposta le opzioni SOAP
        if($this->opzioniSOAP) {
            $this->clientSOAP->setOptions($this->opzioniSOAP);
        }
        //set wsdl
        $this->clientSOAP->setWsdl($this->buildPercorsoWsdl());
    }*/

    /**
    * Imposta l'istanza di SoapClient PHP
    **/
    public function initClientSOAP()
    {
        $this->clientSOAP = new \SoapClient(
            $this->buildPercorsoWsdl(),
            $this->opzioniSOAP
        );
    }

    /**
    * Imposta l'url del webservice da chiamare nel caso in cui sia diverso da quello contenuto nell'elemnto service del file wsdl
    * @param string $urlWebService
    **/
    public function setLocation($urlWebService)
    {
        $this->clientSOAP->__setLocation($urlWebService);
    }

    /**
     * Verifica la correttezza degli argomenti passati con la chiamata ad una operazione
     * @param string $operazione
     * @param array $argomenti
     */
    abstract protected function verificaArgomenti($operazione, $argomenti);

    /**
     * Chiama l'operazione
     * @param string $operazione
     * @param array $argomenti
     */
    public function __call($operazione, $argomenti)
    {
        //~r($this->clientSOAP->getOptions());
        //verifica correttezza degli argomenti
        $this->verificaArgomenti($operazione, $argomenti);
        //chiama operazione
        return call_user_func_array([$this->clientSOAP, $operazione], $argomenti);
    }
}
