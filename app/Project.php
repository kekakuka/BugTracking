<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\BugDate;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'status','company_id'];


    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id','id');
    }

    public function subsystems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Subsystem');
    }
    public function testsuites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Testsuite');
    }
    public function bugsOpenClosed($moreThanDate, $lessThanDate)
    {
        $bugsOpenClosed = new Collection();
        foreach ($this->subsystems as $subsystem) {
            foreach ($subsystem->usecases as $usecase) {
                foreach ($usecase->testcases as $testcase) {
                    foreach ($testcase->tests as $test) {
                        foreach ($test->bugs as $bug) {

                            if (date(date_format($bug->created_at, 'Y-m-d'))>= $moreThanDate && date(date_format($bug->created_at, 'Y-m-d')) <= $lessThanDate) {

                                if ($bugsOpenClosed->count() === 0) {
                                    $bugsOpenClosed->push(new BugDate(date_format($bug->created_at, 'Y-m-d')));
                                    $bugsOpenClosed[0]->addOpen();
                                } else { $has = false;
                                    foreach ($bugsOpenClosed as $item) {
                                        if (date_format($bug->created_at, 'Y-m-d') == $item->date) {
                                            $item->addOpen();
                                            $has = true;
                                            break;
                                        }
                                    }
                                    if ($has === false) {
                                        $newDate=new BugDate(date_format($bug->created_at, 'Y-m-d'));
                                        $newDate->addOpen();
                                        $bugsOpenClosed->push($newDate);
                                    }
                                }
                            }
                            if (($bug->actualFixDate !== null && $bug->actualFixDate !== '') && (date($bug->actualFixDate) >= $moreThanDate && date($bug->actualFixDate) <= $lessThanDate)) {
                                if ($bugsOpenClosed->count() === 0) {
                                    $bugsOpenClosed->push(new BugDate($bug->actualFixDate));
                                    $bugsOpenClosed[0]->addClosed();
                                } else {    $has = false;
                                    foreach ($bugsOpenClosed as $item) {
                                        if ($bug->actualFixDate== $item->date) {
                                            $item->addClosed();
                                            $has = true;
                                            break;
                                        }
                                    }
                                    if ($has === false) {
                                        $newDate=new BugDate($bug->actualFixDate);
                                        $newDate->addClosed();
                                        $bugsOpenClosed->push($newDate);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
		for ($i = 0; $i <$bugsOpenClosed->count()-1; $i++)
			for ($j = 0; $j <$bugsOpenClosed->count()-$i-1; $j++)
				if ($bugsOpenClosed[$j]->date > $bugsOpenClosed[$j + 1]->date) {
                    $temp = $bugsOpenClosed[$j];
                    $bugsOpenClosed[$j] = $bugsOpenClosed[$j+1];
                    $bugsOpenClosed[$j+1]=$temp;
                }

        return $bugsOpenClosed;
    }
    public function overTimeBugsNumbers($moreThanDate, $lessThanDate)
    {
        $overTimeBugsNumbers = 0;
        foreach ($this->subsystems as $subsystem) {
            foreach ($subsystem->usecases as $usecase) {
                foreach ($usecase->testcases as $testcase) {
                    foreach ($testcase->tests as $test) {
                        foreach ($test->bugs as $bug) {

                            if (date(date_format($bug->created_at, 'Y-m-d'))>= $moreThanDate && date(date_format($bug->created_at, 'Y-m-d')) <= $lessThanDate) {


                                if (date($bug->estimatedFixDate)<date($bug->actualFixDate)){
                                    $overTimeBugsNumbers++;
                                }
                            }
                        }
                    }
                }
            }
        }


        return  $overTimeBugsNumbers;
    }
    public function TestsNumber($moreThanDate, $lessThanDate)
    {
        $testsNumber = 0;
        foreach ($this->subsystems as $subsystem) {
            foreach ($subsystem->usecases as $usecase) {
                foreach ($usecase->testcases as $testcase) {
                    foreach ($testcase->tests as $test) {
                            if (date(date_format($test->updated_at, 'Y-m-d'))>= $moreThanDate && date(date_format($test->updated_at, 'Y-m-d')) <= $lessThanDate) {
                                    $testsNumber++;
                            }
                    }
                }
            }
        }
        return  $testsNumber;
    }
    public function WaitingTestsNumber($moreThanDate, $lessThanDate)
    {
        $testsNumber = 0;
        foreach ($this->subsystems as $subsystem) {
            foreach ($subsystem->usecases as $usecase) {
                foreach ($usecase->testcases as $testcase) {
                    foreach ($testcase->tests as $test) {
                        if (date(date_format($test->updated_at, 'Y-m-d'))>= $moreThanDate && date(date_format($test->updated_at, 'Y-m-d')) <= $lessThanDate) {
                            if ($test->status==='waiting'||$test->status==='testing'){
                            $testsNumber++;}
                        }
                    }
                }
            }
        }
        return  $testsNumber;
    }
    public function PassRunNumber($moreThanDate, $lessThanDate)
    {
        $testsNumber = 0;
        $passNumber = 0;
        $runNumber = 0;
        foreach ($this->subsystems as $subsystem) {
            foreach ($subsystem->usecases as $usecase) {
                foreach ($usecase->testcases as $testcase) {
                    foreach ($testcase->tests as $test) {
                        if (date(date_format($test->updated_at, 'Y-m-d'))>= $moreThanDate && date(date_format($test->updated_at, 'Y-m-d')) <= $lessThanDate) {
                            $testsNumber++;
                            if ($test->status!=='waiting'&&$test->status!=='testing'){
                                $runNumber++;
                            }
                            if ($test->status==='pass'){
                                $passNumber++;
                            }
                        }
                    }
                }
            }
        }
if ($runNumber===0){
    return 'No run tests';
}

        return  (number_format($passNumber/$runNumber,'4')*100).'%';
    }

}