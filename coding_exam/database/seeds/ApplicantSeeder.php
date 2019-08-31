<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date_now = Carbon::now();
    	DB::table('applicants')->insert([
	    	[
	            'name' => Str::random(10),
	            'email' => Str::random(10).'@gmail.com',
	            'isHired' => 1,
	            'created_at' => Carbon::now()->subDays(7),
	        ],
	     	[
	            'name' => Str::random(10),
	            'email' => Str::random(10).'@gmail.com',
	            'isHired' => 1,
	            'created_at' => $date_now,
	        ],
	     	[
	            'name' => Str::random(10),
	            'email' => Str::random(10).'@gmail.com',
	            'isHired' => 1,
	            'created_at' => $date_now,
	        ],
	        [
	            'name' => Str::random(10),
	            'email' => Str::random(10).'@gmail.com',
	            'isHired' => 0,
	            'created_at' => $date_now,
	        ],
	        [
	            'name' => Str::random(10),
	            'email' => Str::random(10).'@gmail.com',
	            'isHired' => 0,
	            'created_at' => $date_now,
	        ],
    	]);
    }
}
