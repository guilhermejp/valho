<?php
defined('BASEPATH') OR exit('No direct script access allowed');

set_time_limit(0);

class Fipe extends CI_Controller {

    private $countBrands=0;
    private $countModels=0;
    private $countVersions=0;

    public function __construct(){
		    parent::__construct();
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('Version_model');
        $this->load->helper('file');
        $this->db->cache_off();
    }

  public function remove(){
  
  // Delete all Brands, Models and Versions before inserting
    $this->Brand_model->delete_by('name <> ');
    $this->Model_model->delete_by('name <> ');
    $this->Version_model->delete_by('name <> ');

    echo "All the Fipe tables removed, Now click here to insert new base: <a href='".base_url('fipe_insert')."'> NEW BASE NOW </a>";
  }

	public function update(){

    // Get FIPE API Brands
    $ch = curl_init("http://fipeapi.appspot.com/api/1/carros/marcas.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    // Insert FIPE API Brands
    $data_array = null;

    foreach($response as $value){
      $data_array = array(
          'id' => $value['id'],
          'fipe_key' => $value['key'],
          'name' => $value['name'],
      );
      $this->Brand_model->insert($data_array);
      $this->countBrands++;

      $this->insertModel($value['id']);

    }

    echo "Inserido (".$this->countBrands.") Marcas";
    echo "Inserido (".$this->countModels.") Modelos";
    echo "Inserido (".$this->countVersions.") Versoes";
    

  }

  private function insertModel($brandId){

    // Get FIPE API Model
    $ch = curl_init("http://fipeapi.appspot.com/api/1/carros/veiculos/".$brandId.".json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    // Insert FIPE API Model
    $data_array = null;

    foreach($response as $value){
      $data_array = array(
          'id' => $value['id'],
          'brand_id' => $brandId,
          'fipe_key' => $value['key'],
          'name' => strtoupper($value['name']),
      );
      $this->Model_model->insert($data_array);
      $this->countModels++;

      $this->insertVersion($brandId, $value['id']);
    }

  }


  private function insertVersion($brandId, $modelId){

    // Get FIPE API Model
    $ch = curl_init("http://fipeapi.appspot.com/api/1/carros/veiculo/".$brandId."/".$modelId.".json");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    // Insert FIPE API Model
    $data_array = null;

    foreach($response as $value){

      $retry=0;

      do{
        $fipeArray = $this->getFipeDetail($brandId, $modelId, $value['id']);
        $retorno = ($fipeArray == false || !isset($fipeArray['name'])) ? false : true;
        $retry++;
      }while( $retorno == false && $retry < 5);

      $data_array = array(
          'fipe_code'   => $fipeArray['fipe_codigo'],
          'id'          => $value['id'],
          'fipe_key'    => $fipeArray['key'],
          'brand_id'    => $brandId,
          'model_id'    => $modelId,
          'name'        => $value['name'],
          'ref'         => $fipeArray['referencia'],
          'fuel'        => $fipeArray['combustivel'],
          'year_model'  => $fipeArray['ano_modelo'],
          'price'       => $fipeArray['preco']
      );

      if($retorno){
        $this->Version_model->insert($data_array);
        $this->countVersions++;
      }

    }

  }

  private function getFipeDetail($brandId, $modelId, $versionId){

    // Get FIPE API Details
    $ch = curl_init("http://fipeapi.appspot.com/api/1/carros/veiculo/".$brandId."/".$modelId."/".$versionId.".json");
                     
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $response['preco'] = substr($response['preco'],3);
    $response['preco'] = str_replace(".", "", $response['preco']);

    // Return FIPE API Detail
    return $response;

  }

}
