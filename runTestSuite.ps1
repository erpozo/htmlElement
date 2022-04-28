$date=$(Get-Date).ToString("ddMMyyyy(hhmmss)")
$OutputFileName=$date+"_ReportSuite.html"
./vendor/bin/phpunit --testdox-html ./logs/tests/$OutputFileName --coverage-html ./logs/coverage