<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title_en' => 'How to improve your laravel skills drastically',
            'content_en' => 'start building projects and whenever you neeed a feature, learn how to do it and apply it
                            consistency is key so don\'t neglect that',
            'type_id' => Type::where('name', 'Laravel')->first()->id,
            'title_ar' => 'كيف تطور مهاراتك في لارافيل بشكل سريع و فعال',
            'content_ar' => 'ابدأ بإنشاء المشاريع و عندما تحتاج إالى أي ميزة يمكنك تعلم كيفية تطبيقها, 
                             الاستمرارية هي المفتاح لذلك لا تهمل هذه النقطة',
            'published_at' => now(),
        ]);
    }
}
