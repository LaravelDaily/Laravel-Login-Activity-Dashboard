<?php

namespace App\Http\Repositories;

use App\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class HomeRepository{

    protected $user;

    public function __construct (User $user)
    {
        $this->user = $user;
    }


    public function number_blocks()
    {
        try {
            $number_blocks = [
            [
                'title' => 'Users Logged In Today',
                'number' => User::whereDate('last_login_at', today())->count()
            ],
            [
                'title' => 'Users Logged In Last 7 Days',
                'number' => User::whereDate('last_login_at', '>', today()->subDays(7))->count()
            ],
            [
                'title' => 'Users Logged In Last 30 Days',
                'number' => User::whereDate('last_login_at', '>', today()->subDays(30))->count()
            ],

            [
                'title' => 'Users Logged In Last 90 Days',
                'number' => User::whereDate('last_login_at', '>', today()->subDays(90))->count()
            ],
        ];
                return $number_blocks;

    } catch (\Exception $e) {
        return $e->getMessage();
    }
    }

    public function list_blocks()
    {

        try {
            $list_blocks = [
                [
                    'title' => 'Last Logged In Users',
                    'entries' => User::orderBy('last_login_at', 'desc')
                        ->take(5)
                        ->get(),
                ],
                [
                    'title' => 'Users Not Logged In For 30 Days',
                    'entries' => User::where('last_login_at', '<', today()->subDays(30))
                        ->orwhere('last_login_at', null)
                        ->orderBy('last_login_at', 'desc')
                        ->take(5)
                        ->get()
                ],
            ];
                    return $list_blocks;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function chart_settings(){
        try{

            $chart_settings = [
                'chart_title'        => 'Users By Months',
                'chart_type'         => 'line',
                'report_type'        => 'group_by_date',
                'model'              => 'App\\User',
                'group_by_field'     => 'last_login_at',
                'group_by_period'    => 'month',
                'aggregate_function' => 'count',
                'filter_field'       => 'last_login_at',
                'column_class'       => 'col-md-12',
                'entries_number'     => '5',
            ];

            $chart = new LaravelChart($chart_settings);
            return $chart;

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }


    public function createcaseinfo($data2)
    {
        try {
            return ProviderCaseInfo::create($data2);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function check_order_exists($order_id)
    {
        try {
            return Order::where('receipt_id',$order_id)->exists();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}
