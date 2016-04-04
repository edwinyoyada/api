<?php
namespace App\Http\Controllers\Sicepat;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CalculatesController extends Controller
{

    private $_client;
    private $_apiKey;

    public function __construct()
    {
        $this->_client = new Client();
        $this->_apiKey = '7ebcbb5f88ec5c256a0a43e8dc026db1';

    }

    public function getOrigin()
    {
        $res = $this->_client->request('GET', 'http://api.sicepat.com/customer/origin', ['headers' => ['api-key' => $this->_apiKey]]);
        if ($res->getStatusCode() == 200) {
            $body = json_decode($res->getBody());
            $body = json_encode($body->sicepat->results);
        } else {
            $body = array('status' => 'failed');
        }
        return $body;
    }

    public function getDestination()
    {
        $res = $this->_client->request('GET', 'http://api.sicepat.com/customer/destination', ['headers' => ['api-key' => $this->_apiKey]]);
        if ($res->getStatusCode() == 200) {
            $body = json_decode($res->getBody());
            $body = json_encode($body->sicepat->results);
        } else {
            $body = array('status' => 'failed');
        }
        return $body;
    }

    public function getTariff(Request $request)
    {
        if (isset($request->origin) && isset($request->destination) && isset($request->weight)) {
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->weight;
            $res = $this->_client->request('GET', "http://api.sicepat.com/customer/tariff?origin=$origin&destination=$destination&weight=$weight", ['headers' => ['api-key' => $this->_apiKey]]);
            if ($res->getStatusCode() == 200) {
                $body = json_decode($res->getBody());
                $body = json_encode($body->sicepat->results);
            } else {
                $body = array('status' => 'failed');
            }
        } else {
            $body = array('status' => 'failed');
        }
        return $body;
    }

    public function getWaybill(Request $request)
    {
        if (isset($request->waybill)) {
            $waybill = $request->waybill;

            $res = $this->_client->request('GET', "http://api.sicepat.com/customer/waybill?waybill=$waybill", ['headers' => ['api-key' => $this->_apiKey]]);
            if ($res->getStatusCode() == 200) {
                $body = json_decode($res->getBody());
                $body = json_encode($body->sicepat->results);
            } else {
                $body = array('status' => 'failed');
            }
        } else {
            $body = array('status' => 'failed');
        }
        return $body;
    }

}
