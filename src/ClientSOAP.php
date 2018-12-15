<?php
/**
 * Classe parent delle classi dei singoli SOAP server
 * @author vuk <http://vuk.bg.it>
 */

namespace PHPCraft\FatturazioneElettronica;

use RobRichards\WsePhp\WSSESoap;
use RobRichards\XMLSecLibs\XMLSecurityKey;

abstract class ClientSOAP extends \SoapClient
{
    use AgenteSOAP;

    /**
    * L'istanza di Zend\Soap\Client
    **/
    private $clientSOAP;

    /**
    * Se il client sia in modalità di test (e quindi chiami gli endpoint di test) oppure no, possibili valori 'test' e 'produzione'
    **/
    private $mode = 'test';

    /**
    * Location di test e produzione
    **/
    protected $locations;

    /**
    * Percorso alla chiave privata del client?
    **/
    private $privateKey;

    /**
    * Percorso alla chiave privata del client
    **/
    private $certFile;

    /**
    * Percorso alla chiave privata del client
    **/
    private $caFile;

    /**
    * Percorso alla chiave privata del client
    **/
    private $serviceCert;

    /**
     * Costruttore
     * @param array $opzioniSOAP
     */
    public function __construct($privateKey, $certFile, $caFile, $serviceCert, $opzioniSOAP = [])
    {
        /*$context = stream_context_create([
            'ssl' => [
                'local_cert' => $certFile,
                'cafile' => $caFile,
                'local_pk'   => $privateKey
            ]
        ]);
        $opzioniSOAP['context'] = $context;*/
        parent::__construct(
            $this->buildPercorsoWsdl(),
            $opzioniSOAP
        );
        $this->privateKey = $privateKey;
        $this->certFile = $certFile;
        $this->caFile = $caFile;
        $this->serviceCert = $serviceCert;
        $this->opzioniSOAP = $opzioniSOAP;
    }

    /*public function __doRequest($request, $location, $saction, $version, $one_way = null)
        {
            $doc = new \DOMDocument('1.0');
            $doc->loadXML($request);
            $objWSSE = new WSSESoap($doc);
            // add Timestamp with no expiration timestamp
            $objWSSE->addTimestamp();
            // create new XMLSec Key using AES256_CBC and type is private key
            $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));
            // load the private key from file - last arg is bool if key in file (true) or is string (false)
            $objKey->loadKey($this->privateKey, true);
            // Sign the message - also signs appropiate WS-Security items
            $options = array("insertBefore" => false);
            $objWSSE->signSoapDoc($objKey, $options);
            // Add certificate (BinarySecurityToken) to the message
            $token = $objWSSE->addBinaryToken(file_get_contents($this->certFile));
            // Attach pointer to Signature
            $objWSSE->attachTokentoSig($token);
            $objKey = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $objKey->generateSessionKey();
            $siteKey = new XMLSecurityKey(XMLSecurityKey::RSA_OAEP_MGF1P, array('type' => 'public'));
            $siteKey->loadKey($this->serviceCert, true, true);
            $options = array("KeyInfo" => array("X509SubjectKeyIdentifier" => true));
            $objWSSE->encryptSoapDoc($siteKey, $objKey, $options);
            $retVal = parent::__doRequest($objWSSE->saveXML(), $location, $saction, $version);
            $doc = new \DOMDocument();
            $doc->loadXML($retVal);
            $options = array("keys" => array("private" => array("key" => $this->privateKey, "isFile" => true, "isCert" => false)));
            $objWSSE->decryptSoapDoc($doc, $options);
            return $doc->saveXML();
        }*/

    public function __doRequest($request, $location, $saction, $version, $one_way = null)
        {
            // Call via Curl and use the timeout
            $curl = curl_init(trim($location));
            $saction = 'NotificaEsito';
            $headers = array(
                "Content-type: test/xml;charset=\"utf-8\";action=\"" . $location . '/' . $saction . "\"",
                "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "Content-length: " . strlen($request),
            ); //SOAPAction: your op URL
            curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            curl_setopt($curl, CURLOPT_HEADER, TRUE);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

            //curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->ssl_passphrase);
            curl_setopt($curl,CURLOPT_SSLCERTTYPE,"PEM");
            curl_setopt($curl, CURLOPT_SSH_PRIVATE_KEYFILE, $this->privateKey);
            curl_setopt($curl, CURLOPT_SSLCERT, $this->certFile);
            curl_setopt($curl, CURLOPT_CAINFO, $this->caFile);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new \Exception(curl_error($curl));
            }
            curl_close($curl);

            $soap_start = strpos($response, "<soapenv:Envelope");
            $soap_response = substr($response, $soap_start);

            if (!$one_way) {
                return $soap_response;
            }
            }

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
    * Imposta l'url del webservice da chiamare nel caso in cui sia diverso da quello contenuto nell'elemnto service del file wsdl
    * @param string $urlWebService
    **/
    /*public function setLocation($urlWebService)
    {
        $this->clientSOAP->__setLocation($urlWebService);
    }*/

    /**
    * Imposta la modalità di test o produzione
    * @param string $mode: test | produzione
    **/
    public function setMode(string $mode)
    {
        $this->mode = $mode;
    }

    /**
    * Imposta la location in base alla modalità di test
    **/
    private function setLocation()
    {
        $this->__setLocation($this->locations[$this->mode]);
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
        //imposta location
        $this->setLocation();
        //chiama operazione
        //return call_user_func_array([$this->clientSOAP, $operazione], $argomenti);
        try {
            $out = $this->__soapCall($operazione, $argomenti);
            //var_dump($out);
            return $out;
        } catch (SoapFault $fault) {
            var_dump($fault);
        }
    }
}
