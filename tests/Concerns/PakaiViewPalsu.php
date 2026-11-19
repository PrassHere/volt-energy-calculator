<?php

namespace Tests\Concerns;

use App\Models\User;
use Illuminate\View\FileViewFinder;

/**
 * Login sebagai user dan pakai view palsu (tests/Stubs/views)
 * supaya test tidak bergantung pada tampilan buatan frontend.
 */
trait PakaiViewPalsu
{
    protected function sebagai(User $user): static
    {
        /** @var FileViewFinder $finder */
        $finder = app('view')->getFinder();
        $finder->prependLocation(base_path('tests/Stubs/views'));

        return $this->actingAs($user);
    }
}