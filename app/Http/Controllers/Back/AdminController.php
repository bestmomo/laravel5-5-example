<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\SettingsRequest,
    Repositories\ConfigAppRepository,
    Repositories\EnvRepository,
    Services\PannelAdmin
};
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pannels = [];

        foreach (config('pannels') as $pannel) {

            $panelAdmin = new PannelAdmin($pannel);

            if ($panelAdmin->nbr) {
                $pannels[] = $panelAdmin;
            }
        }

        return view('back.index', compact('pannels'));
    }

    /**
     * Show the settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsEdit()
    {
        $actualLocale = config ('app.locale');
        $locales = locales();

        $actualDriver = env('MAIL_DRIVER');
        $drivers = [
            'smtp' =>'SMTP',
            'mail' => 'PHP'
        ];

        $actualTimezone = config ('app.timezone');
        $timezones = timezones ();

        $actualCacheDriver = env('CACHE_DRIVER');
        $caches = ['apc', 'array', 'database', 'file', 'memcached', 'redis'];

        $actualConnection = env('DB_CONNECTION');
        $connections = ['mysql', 'sqlite', 'pgsql'];

        return view('back.settings', compact (
            'locales',
            'actualLocale',
            'drivers',
            'actualDriver',
            'timezones',
            'actualTimezone',
            'caches',
            'actualCacheDriver',
            'connections',
            'actualConnection'
        ));
    }

    /**
     * Update settings
     *
     * @param \App\Http\Requests\SettingsRequest $request
     * @param \App\Repositories\ConfigAppRepository $appRepository
     * @param \App\Repositories\EnvRepository $envRepository
     * @return \Illuminate\Http\RedirectResponse
     * @internal param ConfigAppRepository $repository
     */
    public function settingsUpdate(
        SettingsRequest $request,
        ConfigAppRepository $appRepository,
        EnvRepository $envRepository)
    {
        $inputs = $request->except ('_method', '_token', 'page');

        $envRepository->update (array_filter($inputs, function ($key) {
            return strpos ($key, '_');
        }, ARRAY_FILTER_USE_KEY ));

        $appRepository->update(array_filter($inputs, function ($key) {
            return !strpos ($key, '_');
        }, ARRAY_FILTER_USE_KEY ));

        $cache = $this->checkCache () ? ' ' . __('Config cache has been updated.'): '';

        $request->session ()->flash ('ok', __('Settings have been successfully saved. ') . $cache);

        return redirect()->route('settings.edit', ['page' => $request->page]);
    }

    /**
     * Check and refresh cache if exists
     *
     * @return bool
     */
    protected function checkCache ()
    {
        if (file_exists (app()->getCachedConfigPath ())) {
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            return true;
        }
        return false;
    }
}
