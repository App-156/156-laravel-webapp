<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // USERS
        $users = array(
            array('login' => 'Juninho',
                  'password' => '1234',
                  'email' => '@hotmail.com',
                  'type' => 'Citizen'),
            array('login' => 'Pedro',
                  'password' => '1234',
                  'email' => 'pedro@hotmail.com',
                  'type' => 'Citizen'),
            array('login' => 'Joao',
                  'password' => '1234',
                  'email' => 'joao@hotmail.com',
                  'type' => 'Citizen')
        );
        DB::table('users')->insert($users);

        // CITIZENS
        $citizens = array(
            array('user_id' => 1,
                  'cpf' => '11111111111',
                  'name' => 'Joao Martins',
                  'cellphone' => '12981111111'),
            array('user_id' => 2,
                  'cpf' => '22222222222',
                  'name' => 'Pedro Alves',
                  'cellphone' => '12982222222'),
            array('user_id' => 3,
                  'cpf' => '33333333333',
                  'name' => 'Joao da Silva',
                  'cellphone' => '12983333333'),
        );
        DB::table('citizens')->insert($citizens);

        // CATEGORIES
        $categories = array(
            array('name' => 'Arborismo',
                  'description' => 'Manutenção de árvores e jardins.'),
            array('name' => 'Trânsito',
                  'description' => 'Serviços relacionados a vias públicas que remetam ao trânsito de pedestres, ciclistas e automóveis.'),
            array('name' => 'Zoonozes',
                  'description' => 'Relacionados aos serviços oferecidos pelo Zoonozes.'),
            array('name' => 'Educação',
                  'description' => 'Instituições de ensino.'),
        );
        DB::table('categories')->insert($categories);

        // SERVICES
        $services = array(
            array('category_id' => 1,
                  'name' => 'Poda de Árvore',
                  'description' => 'Poda parcial de árvores em áreas públicas.'),
            array('category_id' => 1,
                  'name' => 'Análise de árvore',
                  'description' => 'Análise de estado de uma árvore em áreas públicas.'),
            array('category_id' => 1,
                  'name' => 'Plantio de árvore',
                  'description' => 'Plantio de uma nova árvore em áreas públicas.'),
            array('category_id' => 1,
                  'name' => 'Remoção',
                  'description' => 'Solicitação que abrirá análise de remoção para uma árvore em áreas públicas.'),
            array('category_id' => 2,
                  'name' => 'Obstrução de Vias',
                  'description' => 'Notificação de que há uma obstrução de via, podendo ser calçadas e vias.'),
            array('category_id' => 2,
                  'name' => 'Buraco',
                  'description' => 'Notificação de buraco em vias públicas.'),
            array('category_id' => 2,
                  'name' => 'Instalação de Sinalização',
                  'description' => 'Solicitação de instalação de sinalização em alguma via que possua necessidade.'),
            array('category_id' => 3,
                  'name' => 'Animal solto',
                  'description' => 'Animal que está solto oferendo risco aos cidadadãos e ao animal.'),
            array('category_id' => 3,
                  'name' => 'Animal morto',
                  'description' => 'Notificação de animal morto em vias públicas.'),
            array('category_id' => 3,
                  'name' => 'Ploriferação de insetos',
                  'description' => 'Ploriferação de insetos.'),
            array('category_id' => 4,
                  'name' => 'Falta de professores',
                  'description' => 'Reclamação pela falta de professores em escola.'),
            array('category_id' => 4,
                  'name' => 'Merenda',
                  'description' => 'Problemas relacionados a merenda oferecida em escola municipal.'),
            array('category_id' => 4,
                  'name' => 'Estrutura de escola',
                  'description' => 'Problemas na estrutura física de uma escola municipal.'),
        );
        DB::table('services')->insert($services);

        // CITYHALL
        $cityhalls = array(
          array('user_id' => 1,
                'phone1' => '+5512989898988',
                'phone2' => '+55123146547',
                'address' => 'Rua Um',
                'address_number' => '123',
                'address_postalcode' => '22222-222',
                'city' => 'Apt B',
                'state' => 'São Paulo',
                'proof_document' => 'São Paulo',
                'address_complement' => NULL),
          array('user_id' => 1,
                'phone1' => '1222331122',
                'phone2' => '',
                'address' => 'AV.JK',
                'address_number' => '3254',
                'address_postalcode' => '12333-250',
                'city' => 'JACAREI',
                'state' => 'SP',
                'proof_document' => '320513762',
                'address_complement' => 'ANDAR 8'),
        );
        DB::table('cityhall')->insert($cityhalls);

        // CITYHALL SERVICES
        $cityhallservices = array(
            array('cityhall_id' => 1,
                  'service_id' => 1),
            array('cityhall_id' => 1,
                  'service_id' => 2),
            array('cityhall_id' => 1,
                  'service_id' => 3),
            array('cityhall_id' => 1,
                  'service_id' => 4),
            array('cityhall_id' => 1,
                  'service_id' => 9),
        );
        DB::table('cityhallservice')->insert($cityhallservices);
    }
}
