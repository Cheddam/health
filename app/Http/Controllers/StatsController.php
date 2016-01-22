<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Entry;
use DB;

class StatsController extends Controller
{
    /**
     * Returns leaderboards for past week, past 30 days and all-time.
     * @return string JSON-formatted leaderboard data.
     * @todo  Make this way more robust
     * @todo  Caching
     */
    public function getAllLeaderboards()
    {
        $stats = [];

        $stats[] = ['name' => 'Today', 'list' => $this->getTodayLeaderboard()];
        $stats[] = ['name' => 'This Week', 'list' => $this->getCurrentWeekLeaderboard()];
        $stats[] = ['name' => 'Last 30 Days', 'list' => $this->getLastThirtyDaysLeaderboard()];
        // todo: rethink ur life decisions once there's 10000 rows of data to query
        $stats[] = ['name' => 'All Time', 'list' => $this->getAllTimeLeaderboard()];

        return response()->json($stats);
    }

    private function getTodayLeaderboard()
    {
        return $this->getLeaderboardSince(Carbon::today());
    }

    private function getCurrentWeekLeaderboard()
    {
        if (Carbon::now()->dayOfWeek === Carbon::SUNDAY) {
            $cutoffDate = Carbon::parse('monday last week');
        } else {
            $cutoffDate = Carbon::parse('monday this week');
        }

        return $this->getLeaderboardSince($cutoffDate);
    }

    private function getLastThirtyDaysLeaderboard()
    {
        return $this->getLeaderboardSince(Carbon::now()->subDays(30));
    }

    private function getAllTimeLeaderboard()
    {
        return $this->getLeaderboardSince(Carbon::parse('0-0-0'));
    }

    private function getLeaderboardSince(Carbon $date)
    {
        $stats = Entry::select('users.name as name', DB::raw('sum(goals.points) as points'))
            ->where('completed_on', '>=', $date)
            ->join('users', 'users.id', '=', 'entries.user_id')
            ->join('goals', 'goals.id', '=', 'entries.goal_id')
            ->groupBy('entries.user_id')
            ->orderBy('points', 'desc')
            ->limit(5)
            ->get();

        return $stats;
    }
}
