<?php
/**
 * Classe parent delle classi dei singoli SOAP server e client (genericamenti, gli "agenti" SOAP)
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica;

abstract class AgenteSOAP
{
    /**
    * L'istanza di Zend\Soap\Server
    **/
    protected $opzioniSOAP = [];

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
    protected function buildPercorsoWsdl()
    {
        return sprintf(
            '%s/%s.wsdl',
            $this->percorsoWsdl,
            $this->nomeWsdl
        );
    }
}
