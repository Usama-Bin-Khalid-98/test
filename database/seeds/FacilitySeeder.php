<?php

use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('facilities')->insert([
            ['id'=>'1','facility_type_id' => '1','name' => 'Total area (sq.ft)','status' => 'active'],
            ['id'=>'2','facility_type_id' => '1','name' => 'Covered area (sq.ft)','status' => 'active'],
            ['id'=>'3','facility_type_id' => '1','name' => 'Open area (sq.ft)','status' => 'active'],
            ['id'=>'4','facility_type_id' => '1','name' => 'Total student enrollment','status' => 'active'],
            ['id'=>'5','facility_type_id' => '1','name' => 'Open area per student','status' => 'active'],
            ['id'=>'6','facility_type_id' => '2','name' => 'Total number of offices','status' => 'active'],
            ['id'=>'7','facility_type_id' => '2','name' => 'Total faculty members','status' => 'active'],
            ['id'=>'8','facility_type_id' => '2','name' => 'Average number of faculty members per office','status' => 'active'],
            ['id'=>'9','facility_type_id' => '2','name' => 'Workstations/laptops','status' => 'active'],
            ['id'=>'10','facility_type_id' => '2','name' => 'Printer/Photocopier','status' => 'active'],
            ['id'=>'11','facility_type_id' => '2','name' => 'Air conditioning','status' => 'active'],
            ['id'=>'12','facility_type_id' => '2','name' => 'Safe Cabinets','status' => 'active'],
            ['id'=>'13','facility_type_id' => '3','name' => 'Total number of lecture halls','status' => 'active'],
            ['id'=>'14','facility_type_id' => '3','name' => 'Seating capacity (minimum-maximum)','status' => 'active'],
            ['id'=>'15','facility_type_id' => '3','name' => 'Multimedia','status' => 'active'],
            ['id'=>'16','facility_type_id' => '3','name' => 'Whiteboard/blackboard','status' => 'active'],
            ['id'=>'17','facility_type_id' => '3','name' => 'Proper lighting','status' => 'active'],
            ['id'=>'18','facility_type_id' => '3','name' => 'Air Conditioning','status' => 'active'],
            ['id'=>'19','facility_type_id' => '3','name' => 'Multimedia and whiteboard simultaneously useable?','status' => 'active'],
            ['id'=>'20','facility_type_id' => '4','name' => 'Number of libraries','status' => 'active'],
            ['id'=>'21','facility_type_id' => '4','name' => 'Total seating capacity','status' => 'active'],
            ['id'=>'22','facility_type_id' => '4','name' => 'Number of business text books (hardcopy)','status' => 'active'],
            ['id'=>'23','facility_type_id' => '4','name' => 'Number of business reference books (Hardcopy)','status' => 'active'],
            ['id'=>'24','facility_type_id' => '4','name' => 'Number of local journal subscriptions (Hardcopy)','status' => 'active'],
            ['id'=>'25','facility_type_id' => '4','name' => 'Number of new books added in current year','status' => 'active'],
            ['id'=>'26','facility_type_id' => '4','name' => 'Budget spent on new books in current year (PKR)','status' => 'active'],
            ['id'=>'27','facility_type_id' => '4','name' => 'Number of international journal subscriptions','status' => 'active'], 
            ['id'=>'28','facility_type_id' => '4','name' => 'Number of business magazines','status' => 'active'], 
            ['id'=>'29','facility_type_id' => '4','name' => 'Access to HEC digital library','status' => 'active'], 
            ['id'=>'30','facility_type_id' => '4','name' => 'Access to other online databases','status' => 'active'],
            ['id'=>'31','facility_type_id' => '4','name' => 'Database of research publications','status' => 'active'], 
            ['id'=>'32','facility_type_id' => '4','name' => 'Students to computers ratio in library','status' => 'active'],
            ['id'=>'33','facility_type_id' => '5','name' => 'Number of laboratories','status' => 'active'],
            ['id'=>'34','facility_type_id' => '5','name' => 'LAN/WAN networking','status' => 'active'],
            ['id'=>'35','facility_type_id' => '5','name' => 'Internet bandwidth (GBs)','status' => 'active'],
            ['id'=>'36','facility_type_id' => '5','name' => 'Total number of workstations in labs','status' => 'active'],
            ['id'=>'37','facility_type_id' => '5','name' => 'Students to computers ratio','status' => 'active'],
            ['id'=>'38','facility_type_id' => '5','name' => 'List of available softwares','status' => 'active'],
            ['id'=>'39','facility_type_id' => '6','name' => 'Number of multipurpose halls','status' => 'active'],
            ['id'=>'40','facility_type_id' => '6','name' => 'Seating capacity','status' => 'active'],
            ['id'=>'41','facility_type_id' => '7','name' => 'Number of faculty hostels','status' => 'active'],
            ['id'=>'42','facility_type_id' => '7','name' => 'Total capacity of faculty hostel(s)','status' => 'active'],
            ['id'=>'43','facility_type_id' => '7','name' => 'Number of female student hostels','status' => 'active'],
            ['id'=>'44','facility_type_id' => '7','name' => 'Total capacity of female student hostel(s)','status' => 'active'],
            ['id'=>'45','facility_type_id' => '7','name' => 'Number of male student hostels','status' => 'active'],
            ['id'=>'46','facility_type_id' => '7','name' => 'Total capacity of male student hostel(s)','status' => 'active'],
            ['id'=>'47','facility_type_id' => '8','name' => 'Number of vans for faculty transportation','status' => 'active'],
            ['id'=>'48','facility_type_id' => '8','name' => 'Number of vans for students transportation','status' => 'active'],
            ['id'=>'49','facility_type_id' => '9','name' => 'Female students common room','status' => 'active'],
            ['id'=>'50','facility_type_id' => '9','name' => 'Male students common room','status' => 'active'],
            ['id'=>'51','facility_type_id' => '9','name' => 'Prayer room','status' => 'active'],
            ['id'=>'52','facility_type_id' => '9','name' => 'Canteen/cafeteria','status' => 'active'],
            ['id'=>'53','facility_type_id' => '9','name' => 'Gymnasium','status' => 'active'],
            ['id'=>'54','facility_type_id' => '9','name' => 'Playground','status' => 'active'],
            ['id'=>'55','facility_type_id' => '4','name' => 'Number of business reference books (Softcopy)','status' => 'active'],
            ['id'=>'56','facility_type_id' => '4','name' => 'Number of local journal subscriptions (Softcopy)','status' => 'active'],
        ]);
    }
}
