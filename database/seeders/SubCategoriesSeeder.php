<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("insert into sub_categories(id, name) values (0, 'Not Defined');
                        insert into sub_categories(id, name) values (313, 'Reduction');
                        insert into sub_categories(id, name) values (867, 'Grapefruit');
                        insert into sub_categories(id, name) values (870, 'Kiwi');
                        insert into sub_categories(id, name) values (871, 'Apples');
                        insert into sub_categories(id, name) values (872, 'Cherries');
                        insert into sub_categories(id, name) values (873, 'Blueberries');
                        insert into sub_categories(id, name) values (874, 'Blackberries');
                        insert into sub_categories(id, name) values (875, 'Cranberries');
                        insert into sub_categories(id, name) values (876, 'Raspberries');
                        insert into sub_categories(id, name) values (877, 'Strawberries');
                        insert into sub_categories(id, name) values (879, 'Grapes');
                        insert into sub_categories(id, name) values (880, 'Banana');
                        insert into sub_categories(id, name) values (881, 'Pineapple');
                        insert into sub_categories(id, name) values (882, 'Cantaloupe');
                        insert into sub_categories(id, name) values (884, 'Honeydew');
                        insert into sub_categories(id, name) values (885, 'Watermelon');
                        insert into sub_categories(id, name) values (886, 'Peach');
                        insert into sub_categories(id, name) values (887, 'Pear');
                        insert into sub_categories(id, name) values (888, 'Plum');
                        insert into sub_categories(id, name) values (889, 'Apricot');
                        insert into sub_categories(id, name) values (890, 'Avocado');
                        insert into sub_categories(id, name) values (891, 'Fig');
                        insert into sub_categories(id, name) values (892, 'Mango');
                        insert into sub_categories(id, name) values (893, 'Guava');
                        insert into sub_categories(id, name) values (894, 'Coconut');
                        insert into sub_categories(id, name) values (895, 'Dates');
                        insert into sub_categories(id, name) values (896, 'Papaya');
                        insert into sub_categories(id, name) values (897, 'Persimmon');
                        insert into sub_categories(id, name) values (898, 'Pomegranate');
                        insert into sub_categories(id, name) values (899, 'Beet');
                        insert into sub_categories(id, name) values (900, 'Carrot');
                        insert into sub_categories(id, name) values (901, 'Garlic');
                        insert into sub_categories(id, name) values (902, 'Onion');
                        insert into sub_categories(id, name) values (903, 'Potato');
                        insert into sub_categories(id, name) values (904, 'Radish');
                        insert into sub_categories(id, name) values (905, 'Turnip');
                        insert into sub_categories(id, name) values (906, 'Root');
                        insert into sub_categories(id, name) values (907, 'Lettuce');
                        insert into sub_categories(id, name) values (908, 'Salad');
                        insert into sub_categories(id, name) values (909, 'Spinach');
                        insert into sub_categories(id, name) values (910, 'Bean/Pea');
                        insert into sub_categories(id, name) values (911, 'Asparagus');
                        insert into sub_categories(id, name) values (912, 'Cucumber');
                        insert into sub_categories(id, name) values (913, 'Eggplant');
                        insert into sub_categories(id, name) values (914, 'Pepper');
                        insert into sub_categories(id, name) values (915, 'Tomato');
                        insert into sub_categories(id, name) values (916, 'Corn');
                        insert into sub_categories(id, name) values (918, 'Asian');
                        insert into sub_categories(id, name) values (919, 'Artichoke');
                        insert into sub_categories(id, name) values (920, 'Broccoli');
                        insert into sub_categories(id, name) values (921, 'Cabbage');
                        insert into sub_categories(id, name) values (922, 'Cauliflower');
                        insert into sub_categories(id, name) values (923, 'Celery');
                        insert into sub_categories(id, name) values (925, 'Mushroom');
                        insert into sub_categories(id, name) values (926, 'Sprout');
                        insert into sub_categories(id, name) values (927, 'Herbs');
                        insert into sub_categories(id, name) values (928, 'Parsley');
                        insert into sub_categories(id, name) values (929, 'Nuts');
                        insert into sub_categories(id, name) values (1053, 'Anise');
                        insert into sub_categories(id, name) values (1054, 'Clementine');
                        insert into sub_categories(id, name) values (1055, 'Currant');
                        insert into sub_categories(id, name) values (1056, 'Earth Cherry');
                        insert into sub_categories(id, name) values (1057, 'Fancy');
                        insert into sub_categories(id, name) values (1058, 'Hard Squash');
                        insert into sub_categories(id, name) values (1059, 'Leafy Greens');
                        insert into sub_categories(id, name) values (1060, 'Leek');
                        insert into sub_categories(id, name) values (1061, 'Lemon');
                        insert into sub_categories(id, name) values (1062, 'Lime');
                        insert into sub_categories(id, name) values (1063, 'Mandarine');
                        insert into sub_categories(id, name) values (1064, 'Nectarine');
                        insert into sub_categories(id, name) values (1065, 'Olive');
                        insert into sub_categories(id, name) values (1066, 'Orange');
                        insert into sub_categories(id, name) values (1067, 'Shoot');
                        insert into sub_categories(id, name) values (1068, 'Soft Squash');
                        insert into sub_categories(id, name) values (1069, 'Spreads');
                        insert into sub_categories(id, name) values (1070, 'Sweet Potato');
                        insert into sub_categories(id, name) values (1071, 'Syrup');
                        insert into sub_categories(id, name) values (1199, 'Coupon');
                        insert into sub_categories(id, name) values (1244, 'Chunks');
                        insert into sub_categories(id, name) values (1245, 'Salads');
                        insert into sub_categories(id, name) values (1269, 'Apricots');
                        insert into sub_categories(id, name) values (1646, 'Specialty Orders');
                        insert into sub_categories(id, name) values (1652, 'Reduction Organic');
                        insert into sub_categories(id, name) values (1715, 'CPK');
                        insert into sub_categories(id, name) values (1740, 'Seasonal');
                        insert into sub_categories(id, name) values (1837, 'Goji');
                        insert into sub_categories(id, name) values (2027, 'Packaged Nuts');
                        insert into sub_categories(id, name) values (2028, 'Packaged Seeds')");
    }
}
