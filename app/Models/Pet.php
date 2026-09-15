<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'age_years',
        'weight_lbs',
        'breed',
        'gender',
        'location',
        'about',
        'social_level',
        'talkative_level',
        'active_level',
        'is_apartment_friendly',
        'is_studio_friendly',
        'is_potty_trained',
        'is_leash_trained',
        'is_people_friendly',
        'is_dog_friendly',
        'is_vaccinated',
        'is_healthy',

        // สถานะการรับเลี้ยง
        'adoption_status',

        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'age_years' => 'float',

        'weight_lbs' => 'decimal:2',

        'social_level' => 'integer',
        'talkative_level' => 'integer',
        'active_level' => 'integer',

        'is_apartment_friendly' => 'boolean',
        'is_studio_friendly' => 'boolean',
        'is_potty_trained' => 'boolean',
        'is_leash_trained' => 'boolean',
        'is_people_friendly' => 'boolean',
        'is_dog_friendly' => 'boolean',
        'is_vaccinated' => 'boolean',
        'is_healthy' => 'boolean',
    ];

    /**
     * Accessor สำหรับดึงข้อความสถานะการรับเลี้ยง
     *
     * ใช้งานใน Blade:
     * $pet->adoption_status_text
     */
    public function getAdoptionStatusTextAttribute(): string
    {
        switch ($this->adoption_status) {

            case 'available':
                return 'กำลังหาบ้าน';

            case 'pending':
                return 'อยู่ระหว่างการรับเลี้ยง';

            case 'adopted':
                return 'ได้บ้านแล้ว';

            default:
                return 'ไม่ระบุสถานะ';
        }
    }

    /**
     * Accessor สำหรับดึงสีของสถานะ
     *
     * ใช้งานใน Blade:
     * $pet->adoption_status_class
     */
    public function getAdoptionStatusClassAttribute(): string
    {
        switch ($this->adoption_status) {

            case 'available':
                return 'success';

            case 'pending':
                return 'warning';

            case 'adopted':
                return 'secondary';

            default:
                return 'secondary';
        }
    }

    /**
     * Accessor สำหรับดึงข้อความอายุพร้อมหน่วย
     *
     * เรียกใช้งานใน Blade:
     * $pet->formatted_age
     */
    public function getFormattedAgeAttribute(): string
    {
        if ($this->age_years < 1 && $this->age_years > 0) {

            $months = round($this->age_years * 12);

            return $months . ' ' .
                ($months > 1 ? 'months' : 'month');
        }

        $years = (int) $this->age_years;

        return $years . ' ' .
            ($years > 1 ? 'years' : 'year');
    }

    /**
     * Accessor เช็กว่าสัตว์เลี้ยงอายุน้อยกว่า 1 ปี
     *
     * เรียกใช้งานใน Blade:
     * $pet->is_month_age
     */
    public function getIsMonthAgeAttribute(): bool
    {
        return $this->age_years < 1
            && $this->age_years > 0;
    }

    /**
     * Accessor สำหรับแปลงอายุเป็นตัวเลขตามหน่วย
     *
     * เรียกใช้งานใน Blade:
     * $pet->display_age_number
     */
    public function getDisplayAgeNumberAttribute()
    {
        if ($this->is_month_age) {
            return round($this->age_years * 12);
        }

        return $this->age_years;
    }
}