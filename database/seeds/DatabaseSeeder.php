<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Quote;
use App\Admin;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker::create();
        Admin::create([
            'name'=>'Admin',
            'email'=>'Admin@kalemat.com',
            'password'=>bcrypt('12345678@kalemat'),
        ]);

        foreach (range(1,10) as $index) {
            Category::create([
                'name_ar'=>$faker->word,
                'name_en'=>$faker->word,
                'color'=>'#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6),
                'icon'=>'https://image.flaticon.com/icons/svg/1530/1530861.svg',
                'show'=>1,
                'admin_id'=>1,
            ]);
        }

        foreach (range(1,50) as $index) {
            Quote::create([
                'quote_ar'=>$faker->sentence,
                'quote_en'=>$faker->sentence,
                'author_ar'=>$faker->name,
                'author_en'=>$faker->name,
                'tags'=>'love,romance,heart',
                'category_id'=>rand(1,10),
                'admin_id'=>1,
                'show'=>1,
            ]);
        }
    }
}
