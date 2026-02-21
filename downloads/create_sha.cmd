@echo off

del sha256sum.txt
call :CalcSha diatar_13.1.3-1_amd64.deb
call :CalcSha diatar_13.1.3-1_i386.deb
call :CalcSha diatar_13.1.3-1_arm64.deb
call :CalcSha diatar_13.1.3-1_armhf.deb
call :CalcSha diatar-linux_13.1.3_i386.tar.gz
call :CalcSha diatar-linux_13.1.3_x86_64.tar.gz
call :CalcSha diatar-rpios_13.1.3_arm64.tar.gz
call :CalcSha diatar-rpios_13.1.3_armhf.tar.gz
call :CalcSha diatar_13.1.3_win.zip
call :CalcSha diatar_install-v13.1.win.exe
call :CalcSha diatar-program-win.zip
call :CalcSha diatar-program-linux.tar.gz
call :CalcSha diatar-program-rpios.tar.gz

type sha256sum.txt

goto :EOF

:CalcSha

echo %1 ...

FOR /F "skip=3 tokens=2" %%G IN ('PowerShell Get-FileHash -Algorithm SHA256 %1') DO echo %%G *%1 >>sha256sum.txt

rem PowerShell "Get-FileHash -Algorithm SHA256 %1 | % {$_.Hash + ' *' + (Split-Path $_.Path -leaf)}"
rem sha256test.txt
