<?php
/**
 * Classe parent delle classi dei singoli SOAP server
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica;

class ServerSOAP
{
    /**
    * L'istanza di Zend\Soap\Server
    **/
    private $serverSOAP;

    /**
    * L'istanza di Zend\Soap\Server
    **/
    private $opzioniSOAP;

    /**
    * Percorso dalla root del sito alla cartella che contiene i file wsdl e xsd che descriviono i webservice
    **/
    protected $percorsoWsdl = __DIR__ . '/../wsdl';

    /**
    * Nome del file wsdl, impostato nella classe derivata (senza estensione .wsdl)
    **/
    protected $nomeWsdl = null;

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
        $this->serverSOAP->setOptions($this->opzioniSOAP);
        //bind l'istanza della classe al SOAP server Zend
        $this->serverSOAP->setObject($this);
    }

    /**
     * Imposta il percorso ai file wsdl e xsd dalla root del sito nel caso in cui non si utilizzino quelli forniti dalla libreria alll'interno della cartella wsdl
     * @param string $percorsoWsdl
     */
    public function setPercorsoWsdl($percorsoWsdl)
    {
        $this->percorsoWsdl = $percorsoWsdl;
    }

    /**
     * Imposta il nome del file wsdl che descrive il webservice nel caso in cui non si utilizzino quelli forniti dalla libreria alll'interno della cartella wsdl
     * @param string $nomeWsdl
     */
    public function setNomeWsdl($nomeWsdl)
    {
        $this->nomeWsdl = $nomeWsdl;
    }

    /**
    * Builds path to a wsdl
    * @param object $webservice webservice name
    **/
    private function buildPercorsoWsdl()
    {
        return sprintf(
            '%s/%s.wsdl',
            $this->percorsoWsdl,
            $this->nomeWsdl
        );
    }

    /**
     * Avvia il webservice
     */
    public function listen()
    {
        //set wsdl
        $this->serverSOAP->setWsdl($this->buildPercorsoWsdl());
        $this->serverSOAP->handle();
    }
}
