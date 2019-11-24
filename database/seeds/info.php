<?php

use Illuminate\Database\Seeder;

class info extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
        DB::table('info')->delete();
        DB::table('info')->insert([
            ['address'=>'Thường tín','phone'=>'0356653301','user_id'=>1],
            ['address'=>'Bắc giang','phone'=>'0356654487','user_id'=>2],
            ['address'=>'Huế','phone'=>'0352264487','user_id'=>3],
            ['address'=>'Nghệ An','phone'=>'0357846659','user_id'=>4]
        ]);
    }
    }

