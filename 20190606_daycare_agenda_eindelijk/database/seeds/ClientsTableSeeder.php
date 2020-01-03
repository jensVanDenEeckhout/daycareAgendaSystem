<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('cells')->insert(['y' => '1','task_id' => '1','table_id' => '1','time' => '2019-08-05 06:00:00','client_id' => '1','floor_id' => '12']); 
        //DB::table('clients')->insert(['name' => 'Jos Lathouwers', 'medische informatie' => 'mi1', 'medicatielijst' => 'ml2']); 
        //DB::table('clients')->insert(['name' => 'Jos Lathouwers', 'medische informatie' => '/', 'medicatielijst' => '/']); 

        //'' => '', '' => '', '' => '', '' => '', '' => '',]);
       //, 'picture' => 'images/profilePicture.png'


        DB::table('clients')->insert(['name' => 'Jos L', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '12']);
        DB::table('clients')->insert(['name' => 'Kenneth N', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '12']); 
        DB::table('clients')->insert(['name' => 'Dieter c', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '12']);  
        DB::table('clients')->insert(['name' => 'Koen M', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '12']);
        DB::table('clients')->insert(['name' => 'Kristien M', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '12']);  
        DB::table('clients')->insert(['name' => 'Bert V D S', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '12']); 
        
        DB::table('clients')->insert(['name' => 'Filip H', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);   
        DB::table('clients')->insert(['name' => 'Werners E', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);   
        DB::table('clients')->insert(['name' => 'Gert P', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);   
        DB::table('clients')->insert(['name' => 'Annemie S', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);   
        DB::table('clients')->insert(['name' => 'Toon D M', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);   
        DB::table('clients')->insert(['name' => 'Diëgo B', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);   
        DB::table('clients')->insert(['name' => 'Myléne D', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '11']);  

        DB::table('clients')->insert(['name' => 'Carl C', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  
        DB::table('clients')->insert(['name' => 'David D P', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  
        DB::table('clients')->insert(['name' => 'An L', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  
        DB::table('clients')->insert(['name' => 'Toon M', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  
        DB::table('clients')->insert(['name' => 'Dirk R', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  
        DB::table('clients')->insert(['name' => 'Steve d B', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  
        DB::table('clients')->insert(['name' => 'Pascal ', 'medische informatie' => '/', 'medicatielijst' => '/', 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '10']);  

        DB::table('clients')->insert([
            'name' => 'Sven V M', 
            'medische informatie' => 'Hartproblematiek', 
            'medicatielijst' => 'Furosemide EG 40 mg  1 dosis om 9uur
                                Pradaxa 150 mg  2x/dag - om 9u & 21u                            
                                Pulmicort 200   2pufs om 9u & 21u
                                Vanaf 24/04/19 kortdurend amoxicilline 100 mg en mometasone', 
            'nummers' => '- ICE: 0497 07 07 79 (Mama: Regina Robeyns) 
-   Dr Elke de Breuck 052/52 28 70  
In geval van nood mag andere dokter ook', 
            'begeleidingsinfo' => '-    Hartproblematiek  →  veel rust nodig
-   Overschat zichzelf soms
-   Opletten bij kou en hitte
-   Heeft thuis- en poetshulp',
            'begeleidingstaken' => '-   9:00 :
o   SMS controle inname medicatie
o   Controle  van scheren en tanden poetsen
-   21:00 
o   SMS controle inname medicatie
-   Bij ziekte: medicatie goed opvolgen',
            'rijksregisternummer' => '93.09.23-399.54',
            'gsm' => '0498/71 77 93',
            'adres' => 'Molenberg 201 Buggenhout 9255 België', 'picture' => 'images/profilePicture.png','floor_id' => '13']);  
        
        DB::table('clients')->insert(['name' => 'Dorien M', 'medische informatie' => '-   Persoon met epilepsie (opvolging & registratie)
-   Heeft oproepsysteem bij valincidenten
-   Lage bloeddruk
-   Bloedgroep: O+', 'medicatielijst' => 'Asaflow comp 80mg     1 ‘smorgens 8u
                                                            clopidogrel sandoz comp 75mg     1 ’s morgens 8u
                                                            Emconcor minor comp 2.5mg   1 ’s morgens 8u
                                                            Keppra 1000mg comp  1.5 ‘smorgens 8u  &  1.5 ’s avonds 20u
                                                            Lipitor 80 mg comp  1 ’s avonds 18u
                                                            Topamax 100 mg comp 1 ’s morgens 8u & 1 ’s avonds 18u                            
                                                            Paracetamol eg 1g comp  Indien nodig elke 6u, 1 dosis
                                                            '        , 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '13']);  
        DB::table('clients')->insert(['name' => 'Stefan V B', 'medische informatie' => '/', 'medicatielijst' => '/'        , 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '13']);  

        DB::table('clients')->insert(['name' => 'Iedereen', 'medische informatie' => '/', 'medicatielijst' => '/'        , 'nummers' => '/', 'begeleidingsinfo' => '/', 'begeleidingstaken' => '/', 'rijksregisternummer' => '/', 'gsm' => '/', 'adres' => '/', 'picture' => 'images/profilePicture.png','floor_id' => '0']);   

    }
}
