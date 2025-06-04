<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ShareRangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('share_ranges')->insert([
              // Promoter: A significant stake in the company, so they can hold a larger range of shares.
              ['user_type' => 'Promoter', 'min_shares' => 1000, 'max_shares' => 10000, 'active' => true],

              // Member: Generally, Nidhi members will have a smaller shareholding.
              ['user_type' => 'Member', 'min_shares' => 10, 'max_shares' => 100, 'active' => true],
  
              // Employee: Employees may receive a moderate number of shares, usually for benefits or incentives.
              ['user_type' => 'Employee', 'min_shares' => 50, 'max_shares' => 200, 'active' => true],
  
              // Director: Directors have a higher shareholding potential, but less than promoters.
              ['user_type' => 'Director', 'min_shares' => 500, 'max_shares' => 2000, 'active' => true],
  
              // Agents: Agents can hold a smaller number of shares compared to Members or Employees, often for commission or incentives.
              ['user_type' => 'Agent', 'min_shares' => 10, 'max_shares' => 50, 'active' => true],
  
              // Shareholder: This category can be added for general shareholders with a specific range.
             // ['user_type' => 'Shareholder', 'min_shares' => 100, 'max_shares' => 500, 'active' => true],
        ]);
    }
}
