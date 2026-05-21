<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SchoolContact;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     * Share $contact ke seluruh view agar top bar & footer layout
     * dapat menampilkan data kontak dinamis dari database.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Cache array (bukan Eloquent object) untuk menghindari unserialize error
            $data = cache()->remember('school_contact_active', 600, function () {
                $model = SchoolContact::active()->first();
                if ($model) {
                    return $model->toArray();
                }
                return null;
            });

            if ($data) {
                $contact = new SchoolContact($data);
            } else {
                $contact = new SchoolContact([
                    'school_name'    => 'Bimbingan Konseling SMAN 3 Kediri',
                    'address'        => 'Jl. Mauni No 88, Bangsal, Kec. Pesantren, Kota Kediri, Provinsi Jawa Timur 64131',
                    'phone'          => '(0354) 683809',
                    'email'          => 'sman3kdr@sman3kediri.sch.id',
                    'instagram_link' => 'https://www.instagram.com/bk_smaga_kediri/',
                    'youtube_link'   => 'https://www.youtube.com/@sman3kediri',
                    'tiktok_link'    => 'https://www.tiktok.com/@smagakediri_official',
                    'is_active'      => true,
                ]);
            }

            $view->with('contact', $contact);
        });
    }
}
