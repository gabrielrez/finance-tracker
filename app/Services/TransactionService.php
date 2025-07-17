<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    /**
     * Get the date range based on a given period.
     * 
     * @param string $period
     * @return array [Carbon $start, Carbon $end]
     */
    protected function range(string $period, ?Carbon $custom_start = null, ?Carbon $custom_end = null): array
    {
        $now = Carbon::now();

        return match ($period) {
            'this-month' => [
                $now->copy()->startOfMonth(),
                $now->copy()->endOfMonth(),
            ],
            'last-7-days' => [
                $now->copy()->subDays(6)->startOfDay(),
                $now->copy()->endOfDay(),
            ],
            'today' => [
                $now->copy()->startOfDay(),
                $now->copy()->endOfDay(),
            ],
            'custom' => [
                $custom_start ?? $now->copy()->startOfMonth(),
                $custom_end ?? $now->copy()->endOfMonth()
            ],
            default => [
                $now->copy()->startOfMonth(),
                $now->copy()->endOfMonth(),
            ],
        };
    }



    /**
     * Calculate the financial overview for a given user and optional period.
     * 
     * @param User $user The user whose transactions will be analyzed.
     * @param string|null $period Optional period filter (e.g., 'today', 'last-7-days', 'this-month').
     * @return array [$income, $outcome, $balance]
     */
    public function overview(User $user, ?string $period = null): array
    {
        $query = $user->transactions();

        if ($period) {
            $query->whereBetween('date', $this->range($period));
        }

        $income = (clone $query)->where('type', 'income')->sum('amount');
        $outcome = (clone $query)->where('type', 'outcome')->sum('amount');
        $balance = $income - $outcome;

        return [
            'income' => $income,
            'outcome' => $outcome,
            'balance' => $balance,
        ];
    }
}
