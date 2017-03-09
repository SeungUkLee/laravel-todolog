<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name','description','due_date','priority','status'];
    
    protected $dates = ['due_date'];
    
    // task는 하나의 project에 속한다.
    public function project() {
        return $this->belongsTo(Project::class);
    }
    
    // 7.3 쿼리스쿼프 참고 : 자주 쓰는 쿼리 구문을 재사용할 수 있게 해주는 기능
    // 
    public function scopeDueInDays($query, $days) {
        $now = \Carbon\Carbon::now(); // Carbon패키지로 현재 시간을 가져온다
        
        return $query->where('due_date', '>', $now) // 현재 시간보다 큰 데이터를 추가
            ->where('due_date', '<', $now->copy()->addDays($days));
    }

    public function scopeDueDateBetween($query, $start_date, \Carbon\Carbon $end_date) {
        return $query->whereBetween('due_date', [
            $start_date->startOfDay(),
            $end_date->endOfDay()
        ]);
    }
    
    public function scopeOtherParam($query, \Illuminate\Http\Request $request) {
        $priority = $request->get('priority');
        if(!empty($priority) && $priority != 'all') {
            $query = $query->where('priority', $priority);
        }
        
        $status = $request->get('status');
        if(!empty($status) && $status != 'all') {
            $query = $query->where('status', $status);
        }
        
        return $query;
    }
}
