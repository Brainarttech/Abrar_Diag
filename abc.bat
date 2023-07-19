@ECHO OFF
cmd.exe /K "cd C:\xampp\htdocs\AbrarDiagnosticCentre && C: && yii test && timeout /T 5 && exit"
::&& goto top

::echo 'Hi';
::START cmd.exe /k "cd C:\xampp\htdocs\erp_hrm";
::cmd /c cd /d C:\xampp\htdocs\erp_hrm & yii test
::cd C:\xampp\htdocs\erp_hrm &
::yii test
::echo 'opened';
::set /p DUMMY=Hit ENTER to continue...

::do{
    ::$ServerName = Import-Csv -Path "C:\Users\mallee\Desktop\importer0.csv" -Delimiter ";"
    ::$ping= new-object System.Net.NetworkInformation.Ping
    ::set /p DUMMY=Hit ENTER to continue...
    ::echo 'Hi';
    ::set /p DUMMY=Hit ENTER to continue...
    ::start-sleep -Seconds 3
::}until($infinity)
::set /p DUMMY=Hit ENTER to continue...