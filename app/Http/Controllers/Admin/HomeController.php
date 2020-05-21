<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\HomeRepository;


class HomeController
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }


    public function index()
    {

        $number_blocks = $this->homeRepository->number_blocks();

        $list_blocks = $this->homeRepository->list_blocks();

        $chart = $this->homeRepository->chart_settings();

        return view('home', compact('number_blocks', 'list_blocks', 'chart'));
    }
}
