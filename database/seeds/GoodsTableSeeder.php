<?php

use Illuminate\Database\Seeder;
use App\Goods;

class GoodsTableSeeder extends Seeder {

  public function run()
  {
    DB::table('goods')->delete();

    for ($i=0; $i < 10; $i++) {
      Goods::create([
        'title'   => '溜冰鞋和护具 '.$i,
        'cover'    => 'default.jpeg',
        'images' => json_encode(['a.jpg', 'b.jpg', 'c.jpg']),
        'description'    => '物品，是生产、办公、生活领域常用的一个概念。在生产领域中，一般指不参加生产过程，不进入产品实体，而仅在管理、行政、后勤、教育等领域使用的，与生产相关的或有时完全无关的物质实体。在办公生活领域则泛指与办公、生活消费有关的所有物件。在这些领域中，物流学中所称的“物”，就是通常所称的物品。 '.$i,
        'price' => $i * 7,
        'term' => $i * 13,
        'type' => 0,
        'status' => 0,
        'user_id' => 1,
      ]);
    }
  }

}