<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'qty'
    ];

    // Cart item တစ်ခုစီမှာ product တစ်ခုစီပဲ ရှိမှာဖြစ်လို့ belongsTo သုံးရပါမယ်
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Cart item တစ်ခုစီက user တစ်ယောက်နဲ့ပဲ ဆိုင်ပါတယ်
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
