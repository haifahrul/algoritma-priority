<?php
namespace app\controllers;

use yii;
use yii\httpclient\Client;
use yii\helpers\Json;
use yii\base\DynamicModel;

class RestController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionGetProvince($id = 0) {
        $client = new Client();
        $db = Yii::$app->db;
        $addUrl = ($id > 0) ? 'id=' . $id : '';
        $url = 'http://api.rajaongkir.com/starter/province?' . $addUrl;
        $keyApi = ' 5feae2df46d50088102577ca06a3157a';
        $response = $client->createRequest()->setFormat(Client::FORMAT_JSON)->setMethod('get')->setUrl($url)->addHeaders([
                'key' => $keyApi
            ])->send();
        if ($response->isOk) {
            // konvert ke arrray
            $content = Json::decode($response->content); // asArray
            //$content['rajaongkir']['query']
            //$content['rajaongkir']['status']
            $hasils = $content['rajaongkir']['results'];
            // cek hasil resultnya
            if ($id > 0) {
                if ($count($hasils) > 0) {
                    echo $hasils['province_id'] . '-';
                    echo $hasils['province'] . '<br>';
                } else {
                    echo 'blank';
                }
            } else {
                foreach ($hasils as $provinsi) {
                    echo $provinsi['province_id'] . '-' . $provinsi['province'];
                    //simpan ke database
                    // $db->createCommand()->insert('provinsi',[
                    //         'id'=>$provinsi['province_id'],
                    //         'name'=>$provinsi['province']
                    // ])->execute();
                    echo '<br>';
                }
            }
        } else {
            $content = Json::decode($response->content);
            // cek result no response
            echo $content['rajaongkir']['status']['description'];
        }
    }//end controller

    public function actionGetCity($id = 0, $province = 0) {
        $client = new Client();
        $addUrl = ($id > 0) ? '?id=' . $id : '';
        $addUrl .= ($province > 0) ? '?province=' . $province : '';
        $url = 'http://api.rajaongkir.com/starter/city?' . $addUrl;
        $id_key = '5feae2df46d50088102577ca06a3157a';
        $db = Yii::$app->db;
        $response = $client->createRequest()->setFormat(Client::FORMAT_JSON)->setMethod('Get')->setUrl($url)->addHeaders([
                'key' => $id_key
            ])->send();
        //cek return response
        if ($response->isOk) {
            $content = Json::decode($response->content);
            // $content['rajaongkir']['query'];
            // $content['rajaongkir']['status'];
            $results = $content['rajaongkir']['results'];
            if ($id > 0) {
                //spesifik
                if (count($results) > 0) {
                    echo "<h1>" . $results['province_id'] . "-" . $results['province'] . "</h1>";
                    echo $results['city_id'] . "-" . $results['city_name'] . "-" . $results['type'] . "-" . $results['postal_code'] . "<br>";
                } else {
                    echo 'blank or alias kosong';
                }
            } else {
                if (count($results) > 0) {
                    $last_provinsi = 0;
                    foreach ($results as $kota) {
                        // simpan ke db
                        // $db->createCommand()->insert('kota',[
                        //      'id'=>$kota['city_id'],
                        //      'province_id'=>$kota['province_id'],
                        //      'name'=>$kota['city_name'],
                        //      'type'=>$kota['city_type'],
                        //      'postal_code'=>$kota['postal_code']
                        // ])->execute();
                        if ($last_provinsi != $kota['province_id']) {
                            $last_provinsi = $kota['province_id'];
                            echo "<h1>" . $kota['province_id'] . "-" . $kota['province'] . "</h1>";
                        }
                        echo $kota['city_id'] . "-" . $kota['city_name'] . "-" . $kota['type'] . "-" . $kota['postal_code'] . "<br>";
                    }
                } else {
                    //data kosong
                }
            }
        } else {
            $content = Json::decode($response->content);
            // echo $content['rajaongkin']['status']['description']
        }
    }

    public function actionCekOngkir() {
        //origin = asal tempat, courir bisa jne or tiki
        $attribute = ['origin', 'destination', 'weight', 'courier'];
        $kurir = ['jne', 'pos', 'tiki'];
        // url api get harga cost
        $url = 'http://api.rajaongkir.com/starter/cost';
        $model = new DynamicModel($attribute);
        $model->addRule($attribute, 'required');
        $model->addRule(['weigth'], 'integer');
        $model->addRule(['courier'], 'in', [
            'range' => $kurir
        ]);
        $hasil = [];
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data)) {
            $client = new Client();
            $response = $client->createRequest()->setMethod('post')->setUrl($url)->addHeaders(['key' => 'API_KEY'])->setData([
                    'origin' => $model->origin,
                    'destination' => $model->destination,
                    'weight' => $model->weight,
                    'courier' => $model->courier,
                ])->send();
            if ($response->isOk) {
                $hasil = json_decode($response->content);
            }
        }

        return $this->render('cek_ongkir', [
            'model' => $model,
            'results' => $hasil
        ]);
    }

    public function actionGetCekResi($resi = '2784499770009') {
        $url = 'http://api.cekresi.co.id/cnote.php';
        $client = new Client();
        $response = $client->createRequest()->setMethod('post')->setUrl($url)->setData(['id' => $resi])->send();
        if ($response->isOk) {
            echo $response->content;
        }
    }

    // api zenziva
    public function actionSendSms($nomor = '089687477222', $isi = 'test api') {
        //$url ="https://reguler.zenziva.net/apps/smsapi.php?userkey=eo2ph7&passkey=whitecyber&nohp=089687477222&pesan= test kirim ";
        $url = "https://reguler.zenziva.net/apps/smsapi.php";
        $userkey = 'eo2ph7';
        $paskey = 'whitecyber';
        $addUrl = '?userkey=' . $userkey;
        $addUrl .= '&passkey=' . $paskey;
        $addUrl .= '&nohp=' . $nomor;
        $addUrl .= '&pesan=' . $isi;
        $client = new Client();
        $response = $client->createRequest()->setMethod('get')->setUrl($url . $addUrl)->send();
        if ($response->isOk) {
            echo $response->content;
        }
    }

    // cek resi
    public function actionCekResi($pegirim, $noresi) {   //contoh : http://ibacor.com/api/cek-resi?pengirim=TIKI&resi= 020185362011
        $url = 'http://ibacor.com/api/cek-resi';
        $addUrl = '?pengirim=' . $pengirim;
        $addUrl = '&resi=' . $noresi;
        $client = new Client();
        $response = $client->createRequest()->setMethod('get')->setUrl($url . $addUrl)->send();
        if ($response->isOk) {
            $konten = $response->getContent(); // json
            echo Json::decode($konten);
        } else {
            echo "tidak ada";
        }
    }

    // list semua barang
    public function actionListBank() {
        $url = 'http://ibacor.com/api/kurs';
        $client = new Client();
        $response = $client->createRequest()->setMethod('get')->setUrl($url)->send();
        if ($response->isOk) {
            $konten = $response->getContent(); // json
            $data = Json::decode($konten);
            //                Yii::$app->response->format ="json";
            //                echo $konten;
        } else {
            //echo "tidak ada";
        }
    }
}
