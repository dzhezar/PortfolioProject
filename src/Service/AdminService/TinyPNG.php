<?php


namespace App\Service\AdminService;

/**
 * Class to use the TinyPNG-API to shrink / compress PNG files.
 * @author Sebastian Brosch <sebastian.brosch@brosch-software.de>
 * @copyright 2014 Sebastian Brosch
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU GPL Version 3
 * @see https://tinypng.com/developers/reference
 * @version 1.0.0
 */
class TinyPNG
{
    private $curl = null;
    private $response = array();
    private $shrink_url = 'https://api.tinypng.com/shrink';

    public function __construct($key)
    {
        if ($this->curl === null) {
            $this->curl = curl_init();

            $curlOptions = array(
                CURLOPT_BINARYTRANSFER => 1,
                CURLOPT_HEADER => 1,
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $this->shrink_url,
                CURLOPT_USERAGENT => 'TinyPNG PHP v1',
                CURLOPT_USERPWD => 'api:' . $key,
            );
            curl_setopt_array($this->curl, $curlOptions);
        }
    }

    public function download($file)
    {
        if (isset($this->response['header']) === false) {
            return false;
        }

        foreach (explode("\r\n", $this->response['header']) as $header) {
            if (substr($header, 0, 10) === 'Location: ') {

                $this->curl = curl_init();

                $curlOptions = array(
                    CURLOPT_URL => substr($header, 10),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => 0
                );
                curl_setopt_array($this->curl, $curlOptions);

                return (file_put_contents($file, curl_exec($this->curl)) !== false);
            }
        }

        return false;
    }

    public function getErrorMessage()
    {
        $content = json_decode($this->response['content'], true);

        if ((isset($content['error']) === true) && (isset($content['message']) === true)) {
            return $content['error'] . ': ' . $content['message'];
        }

        return '';
    }

    public function shrink($file)
    {
        if (file_exists($file) === false) {
            return false;
        }

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, file_get_contents($file));

        $response = curl_exec($this->curl);
        $http_code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        $this->response['header'] = substr($response, 0, curl_getinfo($this->curl, CURLINFO_HEADER_SIZE));
        $this->response['content'] = substr($response, curl_getinfo($this->curl, CURLINFO_HEADER_SIZE));

        if ($http_code === 201) {
            return true;
        }

        return false;
    }
}