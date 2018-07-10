<?php

namespace Subdesign\LaravelWebfaction;

use PhpXmlRpc\Client;
use PhpXmlRpc\Request;
use PhpXmlRpc\Value;
use Subdesign\LaravelWebfaction\Exceptions\WebfactionException;

/**
 * Webfaction API wrapper for Laravel
 *
 * @version 1.0.0
 * @author Barna Szalai <szalai.b@gmail.com>
 * 
 */
class Webfaction {

    const END_POINT = 'https://api.webfaction.com/';

    /**
     * Session ID for API calls
     * 
     * @var string
     */
    protected $sessionId;

    /**
     * Control panel username
     * 
     * @var string
     */
    protected $username;

    /**
     * Control panel password
     * 
     * @var string
     */
    protected $password;

    /**
     * Web server name
     * 
     * @var string
     */
    protected $machine;

    /**
     * API version number
     * 
     * @var integer
     */
    protected $version;

    protected $arrayResult;

    /**
     * API client
     * 
     * @var object
     */
    protected $client;

    /**
     * API call response
     * 
     * @var object
     */
    protected $response;

    /**
     * Valid api callback based on : https://docs.webfaction.com/xmlrpc-api/apiref.html
     * 
     * @var [type]
     */
    protected static $validCallbacks = [
        'list_disk_usage',
        'change_mailbox_password',
        'create_mailbox',
        'delete_mailbox',
        'list_mailboxes',
        'update_mailbox',
        'create_email',
        'delete_email',
        'list_emails',
        'update_email',
        'create_certificate',
        'delete_certificate',
        'list_certificates',
        'update_certificate',
        'create_domain',
        'delete_domain',
        'list_domains',
        'create_website',
        'delete_website',
        'list_bandwidth_usage',
        'list_websites',
        'update_website',
        'create_app',
        'delete_app',
        'list_apps',
        'list_app_types',
        'create_cronjob',
        'delete_cronjob',
        'create_dns_override',
        'delete_dns_override',
        'list_dns_overrides',
        'change_db_user_password',
        'create_db',
        'create_db_user',
        'delete_db',
        'delete_db_user',
        'enable_addon',
        'grant_db_permissions',
        'list_dbs',
        'list_db_users',
        'make_user_owner_of_db',
        'revoke_db_permissions',
        'replace_in_file',
        'write_file',
        'change_user_password',
        'create_user',
        'delete_user',
        'list_users',
        'list_ips',
        'list_machines',
        'run_php_script',
        'set_apache_acl',
        'system'
    ];

    /**
     * Build up properties from config, and run login
     * 
     * @param array $config [description]
     */
    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new WebfactionException("Config file is empty!");            
        }

        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }

        $this->login();
    }

    /**
     * Log in to the service
     * 
     * @return [type] [description]
     */
    private function login()
    {
        $response = $this->sendRequest('login', [$this->username, $this->password, $this->machine]);

        $responseValue = (array) $response[0];

        $this->sessionId = $responseValue['me']['string'];
    }

    /**
     * Get the XML-RPC client
     * 
     * @return object
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = new Client(self::END_POINT);
        }

        return $this->client;
    }

    /**
     * Handle all API calls other than 'login'
     * 
     * @param  string $name      [description]
     * @param  array  $arguments [description]
     * @return object
     */
    public function __call($name, array $arguments)
    {        
        if (in_array($name, self::$validCallbacks)) {
            return $this->sendRequest($name, $arguments);
        }

        if ($name == 'login') {
            throw new WebfactionException("You can't call 'login' directly");        
        } else {
            throw new WebfactionException("Following Api method not found: ".$name);        
        }
    }

    /**
     * Send the request to API
     * 
     * @param  string $name      [description]
     * @param  array  $arguments [description]
     * @return mixed            [description]
     */
    public function sendRequest($name, array $arguments)
    {        
        $payloadArray = [];

        if ($name !== 'login') {
            $payloadArray[] = new Value($this->sessionId);
        }

        if (is_array($arguments)) {
            $arguments = array_flatten($arguments);
        }

        foreach ($arguments as $argument) {            
            $payloadArray[] = new Value($argument);                
        }
        
        $this->response = $this->getClient()->send(new Request($name, $payloadArray));

        if ($this->response->faultCode() > 0) {
            $this->apiError($this->response->faultCode(), $this->response->faultString());
        }
        
        return $this->response->value();                    
    }

    /**
     * Throw exception on API error
     * 
     * @param  integer $code    [description]
     * @param  string  $message [description]
     * @return object           [description]
     */
    private function apiError($code, $message) {
        throw new WebfactionException("Error code ".$code.", Error message: ".$message);
    }

}