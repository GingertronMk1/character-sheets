<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Character extends Model
{
    public static function boot(): void
    {
        parent::boot();
        self::saving(function (self $model) {
            if ($model->isDirty('name')) {
                $model->slug = Str::slug($model->name);
                if (self::where('slug', $model->slug)->exists()) {
                    $i = 1;
                    do {
                        $model->slug = Str::slug($model->name) . '-' . $i++;
                    } while (self::where('slug', $model->slug)->exists());
                }
            }
        });
    }
    protected $fillable = [
        'armour_class',
        'armours',
        'class',
        'inspiration',
        'level',
        'name',
        'passive_perception',
        'proficiency_bonus',
        'race',
        'saving_throws',
        'speed',
        'weapons',
    ];

    protected $attributes = [
        'armour_class' => 10,
        'armours' => '{}',
        'class' => 'Test',
        'inspiration' => false,
        'level' => 1,
        'name' => 'Test',
        'passive_perception' => 10,
        'proficiency_bonus' => 2,
        'race' => 'Test',
        'saving_throws' => '{}',
        'speed' => 30,
        'weapons' => '{}',
    ];

    protected function casts(): array
    {
        return [
            'abilities' => 'array',
            'armours' => 'array',
            'saving_throws' => 'array',
            'skills' => 'array',
            'weapons' => 'array',
        ];
    }
}
