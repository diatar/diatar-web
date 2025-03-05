@echo off

del sha256sum.txt
call :CalcSha diatar_13.0.8-1_amd64.deb
call :CalcSha diatar_13.0.8-1_i386.deb
call :CalcSha diatar_13.0.8-1_arm64.deb
call :CalcSha diatar_13.0.8-1_armhf.deb
call :CalcSha diatar-linux_13.0.8_i386.tar.gz
call :CalcSha diatar-linux_13.0.8_x86_64.tar.gz
call :CalcSha diatar-rpios_13.0.8_arm64.tar.gz
call :CalcSha diatar-rpios_13.0.8_armhf.tar.gz
call :CalcSha diatar_13.0.9_win.zip
call :CalcSha diatar_install-v13.0.win.exe
call :CalcSha diatar-program-win.zip
call :CalcSha diatar-program-linux.tar.gz
call :CalcSha diatar-program-rpios.tar.gz

type sha256sum.txt

goto :EOF

:CalcSha

FOR /F "skip=3 tokens=2" %%G IN ('PowerShell Get-FileHash -Algorithm SHA256 %1') DO echo %%G *%1 >>sha256sum.txt

rem PowerShell "Get-FileHash -Algorithm SHA256 %1 | % {$_.Hash + ' *' + (Split-Path $_.Path -leaf)}"
rem sha256test.txt
