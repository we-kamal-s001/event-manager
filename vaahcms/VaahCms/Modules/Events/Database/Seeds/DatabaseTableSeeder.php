<?php
namespace VaahCms\Modules\Events\Database\Seeds;


use Illuminate\Database\Seeder;
use WebReinvent\VaahCms\Libraries\VaahSeeder;

class DatabaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds();
        $this->seedPermissions();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    function seeds()
    {

    }
    public function seedPermissions()
    {
        $json_file_path = __DIR__."/json/permission.json";
        VaahSeeder::permissions($json_file_path);
    }

}
