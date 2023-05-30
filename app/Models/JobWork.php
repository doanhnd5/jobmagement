<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobWork extends Model
{
    use HasFactory;

    protected $table = 'job_work';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function getJobWorkList($srchList)
    {
        $jobWorkList = $this->leftJoin('job_tag', 'job_tag.job_id', 'job_work.id')
            ->when(isset($srchList['srchArea']), function($query) use ($srchList) {
                $query->where('job_work.workplace_prefecture', '=', $srchList['srchArea']);
            })->when(isset($srchList['srchJobType']), function($query) use ($srchList) {
                $query->where('job_work.employment_type_id', '=', $srchList['srchJobType']);
            })->when(isset($srchList['srchTag']), function($query) use ($srchList) {
                $query->where('job_tag.tag_id', '=', $srchList['srchTag']);
            })->where(function($query) use ($srchList) {
                $query->when(isset($srchList['srchKeyAny']), function($subQuery) use ($srchList) {
                    $srchJobType = $srchList['srchKeyAny'];
                    $subQuery->where('job_work.job_name', 'like', "%$srchJobType%")
                        ->orWhere('job_work.company_name', 'like', "%$srchJobType%")
                        ->orWhere('job_work.workplace_city', 'like', "%$srchJobType%");
                });
            })
            ->where('job_work.is_important', false)
            ->
            select(
                'job_work.id',
                'job_work.job_name',
                'job_work.employment_type_id',
                'job_work.company_name',
                'job_work.salary',
                'job_work.work_time_from',
                'job_work.work_time_to',
                'job_work.workplace_prefecture',
                'job_work.workplace_city'
            )->orderBy('job_work.id', 'asc')
            ->distinct()
            ->get();
        return $jobWorkList;
    }

    public function getHotJobList()
    {
        $hotJobList = $this->where('is_important', true)
            ->select(
            'job_work.id',
            'job_work.job_name',
            'job_work.employment_type_id',
            'job_work.company_name',
            'job_work.salary',
            'job_work.work_time_from',
            'job_work.work_time_to',
            'job_work.workplace_prefecture',
            'job_work.workplace_city'
            )->orderBy('job_work.id', 'asc')
            ->get();
        return $hotJobList;
    }
}
