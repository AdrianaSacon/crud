<?php

namespace App\Controllers;
// use App\Models

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    } 
    

    public function prueba ()
    {
        echo 'hola esto es una prueba';
    }

    public function api ()
    {

        echo 'Bienvenido al API REST';

        $descrip= array (
                "usuario"=>"Adriana",
                "nombres"=>"Adriana Sacon",
                "Ciudad"=>"Pichincha",
                "Direccion"=>"Manabí",
                "telefono"=>"+59091091900"
    
    );

          $usuarios= array (
            "usuario"=>"Shein",
            "nombres"=>"Ropa Americana",
            "Ciudad"=>"Estados Unidos",
            "Direccion"=>"China",
            "Categoria"=>"Ropa,vestidos,ropa playera,lenceria y lounge,zapatos,accesorios,hogar y mascotas,denim,belleza y salud",
            "Talla"=>"bebes de 0-3años,niños de 3años-13años,adultos"  

        );
        $publicacion= array (
            "usuario"=>"Samsung Galaxy A13",
            "nombres"=>"Telefonos en alta gama",
            "Ciudad"=>"Portoviejo",
            "Direccion"=>"Via Manta",
            "Pantalla"=>"Tamaño 6.6",
            "Cámara Principal"=>"50 MP + 2 MP + 2 MP",
            "Multimedia"=>"Reproductor de música.Reproductor de video Radio FM",
            "Batería"=>"5000 mAh"

        );

        $publi= array (
            "usuario"=>"Lavadora secadora Samsung",
            "nombres"=>"Jose Delgado",
            "Ciudad"=>"Guayaquil",
            "Direccion"=>"Los Olivos",
            "Ahorro de energ"=>"Sí",
            "Peso"=>"80 kg",
            "Profundidad"=>"650 mm",
            "Velocidad de centrifugado"=>"1400 RPM",
            "Garantía del proveedor"=>"20 años motor de lavadora"


        );
        $publicac= array (
            "usuario"=>"Amazon",
            "nombres"=>"Jeff Bezos",
            "Empresa"=>"venta de correo de comercio electrónico",
            "Servicios"=>"almacenamiento,redes,bases de datos,servicios de aplicaciones web y móviles,seguridad,potencia de computo ",
            "Ciudad"=>"Bellevue,Washington,Estados Unidos"

        );
        
    $resultado = array($descrip,  $usuarios, $publicacion,$publi,$publicac );

    return $this->response->setJSON($resultado);
    }   

        

    public function login(){

return view('login');
    
    }


    public function testbd($cedula)
    {

        $this->db=\Config\Database::connect();
        $query=$this->db->query("SELECT idpersonal, cedula, apellido1, apellido2, nombres, genero 
        FROM esq_datos_personales.personal where cedula='$cedula'  ");
        $result=$query->getResult();
        return $this->response->setJSON($result);


        // echo "hola";
    
    }
}
