<?php

function buildrelease($release){
    if(is_object($release)){
        $release = build_one_release($release);
    }else if(is_array($release)){
        foreach($release as $i=>$releaseitem){
            $release[$i] = build_one_release($releaseitem);
        }
    }

    return $release;
}

function build_one_release($release){
    $release->link = base_url('ver-lancamento/'.$release->id);
    $release->hotsite = $release->url;
    $release->url = base_url('lancamentos/'.url_title($release->name, '-', TRUE).'/'.$release->id);
    $release->img = base_url('assets/uploads/releases/'.$release->id.'/'.$release->img);
    if(!empty($release->logo)){
        $release->logo = base_url('assets/uploads/releases/'.$release->id.'/'.$release->logo);
    }
    $release->landing = base_url('assets/uploads/releases/'.$release->id.'/'.$release->landing);
    $release->detail_img = base_url('assets/uploads/releases/'.$release->id.'/'.$release->detail_img);

    if(!empty($release->releases_medias)){
        foreach($release->releases_medias as $i=>$media){
            $release->releases_medias[$i]->img = base_url('assets/uploads/releases/'.$release->id.'/'.$media->img);
            $type = $media->type;
            if($type == 1){
                @$release->releases_medias1[$i]->img = $media->img;
            }else{
                @$release->releases_medias2[$i]->img = $media->img;
            }
        }
    }

    return $release;
}
