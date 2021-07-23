<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{

    private $redirectUrl = NULL;
    private $key = 'cbebd4472d5634eb97f9c0526a21a479';

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->helper('image');
        $this->load->model('common_model');
        $this->load->model('Product_model');

        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        $this->redirectUrl = (!empty($params)) ? $currentURL . '?' . $params : $currentURL;
    }


    public function index()
    {
        $data["redirectUrl"] = $this->redirectUrl;

        // $dataongkir = $this->postCost();

        $response = $this->getProvinsi();
        $provinsi = json_decode($response, true);

        $this->template->load('admin/template', 'admin/page/rajaongkir', compact('provinsi'));
    }

    function getProvinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: {$this->key}"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function getKota($provinsi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/city?&province=" . $provinsi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: {$this->key}"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $kota = json_decode($response, true);

            if ($kota['rajaongkir']['status']['code'] == '200') {
                echo "<option value=''>Pilih Kota</option>";
                foreach ($kota['rajaongkir']['results'] as $kt) {
                    echo "<option value='$kt[city_id]'>$kt[city_name]</option>";
                }
            }
        }
    }

    public function postCost()
    {
        $data['ongkir'] = '';

        if (count($_POST)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=" . $this->input->post('kota') .
                    "&originType=city" . "&destination=" . $this->input->post('kota_tujuan') .
                    "&destinationType=.subdistrict" . "&weight=" . $this->input->post('berat') .
                    "&courier=" . $this->input->post('expedisi'),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: {$this->key}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                $data['ongkir'] = $response;
            }
        }
        $this->template->load('admin/template', 'admin/page/rajaongkir', $data);
    }
}