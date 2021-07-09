<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Artista;

class ApiController extends Controller
{
    //

    public function obtenerGeneros(){
        $curl = curl_init(); 

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.deezer.com/genre",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            //CURLOPT_ENCONDING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                "x-rapidapi-key: SIGN-UP-FOR-KEY"
            ],

        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            echo "curl error #:". $err;
        }else{
            $objeto = json_decode($response);
            foreach ($objeto->data as $genero){
                echo json_encode($genero);
                
                $verificar = Genero::where('name',$genero->name)->first();
                if(!$verificar)
                    $nuevoGenero = new Genero();

                $nuevoGenero->name = $genero->name;
                $nuevoGenero->id = $genero->id;
                $nuevoGenero->save();


                if(isset($genero->picture))
                echo "<img src='$genero->picture' alt=''>";

                if(isset($genero->picture_small))
                echo "<img src='$genero->picture_small' alt=''>";

                if(isset($genero->picture_medium))
                echo "<img src='$genero->picture_medium' alt=''>";

                if(isset($genero->picture_big))
                echo "<img src='$genero->picture_big' alt=''>";

                if(isset($genero->picture_xl))
                echo "<img src='$genero->picture_xl' alt=''>";

            echo "<hr>";


            }

        }
    }

    public function obtenerGenero($id){
        $genero = Genero::Where('id', $id)
        ->first();
        return ['genero' => $genero];
    }

    public function obtenerNombre($nombre){
        $genero = Genero::Where('name', $nombre)
        ->first();
        return ['genero' => $genero];
    }



    public function obtenerArtistas($id){
        $curl = curl_init(); 

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.deezer.com/artist/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            //CURLOPT_ENCONDING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                "x-rapidapi-key: SIGN-UP-FOR-KEY"
            ],

        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            echo "curl error #:". $err;
        }else{
            $objeto = json_decode($response);
                
                $verificar = Artista::where('name',$objeto->name)->first();
                if(!$verificar)
                    $nuevoArtista = new Artista();
                    $nuevoArtista->name = $objeto->name;
                    $nuevoArtista->id = $objeto->id;
                    $nuevoArtista->save();

                    echo"Agregado<br>";
                    echo $objeto->name;

                    if(isset($objeto->picture))
                    echo "<img src='$objeto->picture' alt=''>";

                    if(isset($objeto->picture_small))
                    echo "<img src='$objeto->picture_small' alt=''>";

                    if(isset($objeto->picture_medium))
                    echo "<img src='$objeto->picture_medium' alt=''>";

                    if(isset($objeto->picture_big))
                    echo "<img src='$objeto->picture_big' alt=''>";

                    if(isset($objeto->picture_xl))
                    echo "<img src='$objeto->picture_xl' alt=''>";
        
        }
    }
    

    public function obtenerArtista($id){
        $artista = Artista::Where('id', $id)
        ->first();
        return ['Artista' => $artista];
    }

    

}
