<?php


function buildimovel($imovel){
	if(is_array($imovel)){
		foreach($imovel as $i=>$imovelitem){
			$imovel[$i] = build_one_imovel($imovelitem);
		}
	}else{
		$imovel = build_one_imovel($imovel);
	}

	return $imovel;
}

function build_one_imovel($imovel){
	if($imovel->base == 'cpv2001'){
		$link = url_title(convert_accented_characters('comprar'), '-', TRUE).'/';
	}else{
		$link = url_title(convert_accented_characters('alugar'), '-', TRUE).'/';
	}
	$link .= url_title(convert_accented_characters($imovel->type), '-', TRUE).'/';
	$link .= url_title(convert_accented_characters($imovel->city), '-', TRUE).'/';
	$link .= url_title(convert_accented_characters($imovel->neighborhood), '-', TRUE).'/';
	$link .= url_title(convert_accented_characters($imovel->id), '-', TRUE).'/';
	//$imovel->property_url = base_url($link);
	$imovel->property_url = 'http://www.anuardonato.com.br/'.$link;
	//$imovel->url = base_url('ver-imovel/'.$imovel->id);
	$imovel->url = 'http://www.anuardonato.com.br/ver-imovel/'.$imovel->id;
	$imovel->useful_area = number_format($imovel->useful_area, 0);

	$imovel->address = str_replace(array('Varios', 'Vários', 'varios', 'vários'), '', $imovel->address);
	$imovel->city = str_replace(array('Varios', 'Vários', 'varios', 'vários'), '', $imovel->city);

	$imovel->cover = FALSE;
	if(isset($imovel->images)){
		foreach($imovel->images as $j=>$imagemitem){
			//$file_headers = @get_headers('http://www.anuardonato.com.br/assets/uploads/property/'.$imagemitem->path);
			//var_dump($imagem->url_amigavel);
			//var_dump($file_headers);
			if(/*$file_headers[0] == 'HTTP/1.1 404 Not Found' ||*/ $imagemitem->status == 2){
				unset($imovel->images[$j]);
			}else{
				//$imovel->images[$i]->path = base_url('assets/uploads/property/'.$imagemitem->path);
				$imovel->images[$j]->path = 'http://www.anuardonato.com.br/assets/uploads/property/'.$imagemitem->path;
			}
		}
		usort($imovel->images, function($a, $b){
			return ($a->position > $b->position)?1:-1;
		});
		if(count($imovel->images) > 0){
			for($k=0;$k<1;$k++){
				$imovel->cover = $imovel->images[$k]->path;
			}
		}else{
			$imovel->cover = FALSE;
		}
	}

	return $imovel;
}

?>
