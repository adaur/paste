<?php
/*
* $ID Project: Paste 2.0 - J.Samuel - 29/09/2013 @ 04:11 (Coffee please!)
* This is the configuration file for paste. See /docs for more information.
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 3
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License in LIC.txt for more details.
*/
 
// Database information
$CONF['dbhost']='localhost';
$CONF['dbname']='paste';
$CONF['dbuser']='root';
$CONF['dbpass']='';

// These extra databases are supported: postgresql
$CONF['dbsoftware']='mysql';

// This should be the entire URL to your PASTE installation.
$CONF['url']='http://localhost/paste/'; // Make sure you end it with a slash! (/)
// And the title
$CONF['sitetitle']='Paste 2.0';

// Enable mod_rewrite? remember to move htaccess.txt to .htaccess!
$mod_rewrite=false;

// What is the name of the template you want to use for the frontend (the folder name as displayed in /templates/)
$CONF['template']='default';

// Select your language. English and french are availables by default.
$CONF['language']='french';

// Select how many posts you want to be displayed on the right side of your website
$CONF['recentposts']=10;

// Enable reCAPTCHA to help prevent spambots?
$CONF['useRecaptcha'] = false;
// Get your keys at http://www.google.com/recaptcha
$CONF['pubkey']='public-key-here';
$CONF['privkey']='private-key-here';

// This is a random string used for extra security for passwords (slows down dictionary attacks for really weak passwords)
// Generate new random salts at http://mkpasswd.net/
$salt='c7428522a9f84320ad63275162904a';

/* 
* You can set the format of the paste ID here which will be used in URLs.
* Examples: http://php.net/manual/en/function.sprintf.php
*/
$CONF['pid_format']='%d';

// Default expiry time - d (day), m (month), and f (forever).
$CONF['default_expiry']='f';

// The maximum number of posts you want to keep. Keep this as-is if you want no limits.
$CONF['max_posts']=0;

// Default syntax highlight for pastes.
$CONF['default_highlighter']='text';

// Available formats (All GeSHi formats are here)
$CONF['geshiformats']=array(
	'4cs'=>'GADV 4CS',
	'6502acme'=>'ACME Cross Assembler',
	'6502kickass'=>'Kick Assembler',
	'6502tasm'=>'TASM/64TASS 1.46',
	'68000devpac'=>'HiSoft Devpac ST 2',
	'abap'=>'ABAP',
	'actionscript'=>'ActionScript',
	'actionscript3'=>'ActionScript 3',
	'ada'=>'Ada',
	'aimms'=>'AIMMS3',
	'algol68'=>'ALGOL 68',
	'apache'=>'Apache',
	'applescript'=>'AppleScript',
	'apt_sources'=>'Apt sources.list',
	'arm'=>'ARM Assembler',
	'asm'=>'ASM',
	'asp'=>'ASP',
	'asymptote'=>'Asymptote',
	'autoconf'=>'Autoconf',
	'autohotkey'=>'Autohotkey',
	'autoit'=>'AutoIt',
	'avisynth'=>'AviSynth',
	'awk'=>'Awk',
	'bascomavr'=>'BASCOM AVR',
	'bash'=>'BASH',
	'basic4gl'=>'Basic4GL',
	'bf'=>'Brainfuck',
	'bibtex'=>'BibTeX',
	'blitzbasic'=>'BlitzBasic',
	'bnf'=>'BNF',
	'boo'=>'Boo',
	'c'=>'C',
	'c_loadrunner'=>'C (LoadRunner)',
	'c_mac'=>'C for Macs',
	'c_winapi'=>'C (WinAPI)',
	'caddcl'=>'CAD DCL',
	'cadlisp'=>'CAD Lisp',
	'cfdg'=>'CFDG',
	'cfm'=>'ColdFusion',
	'chaiscript'=>'ChaiScript',
	'chapel'=>'Chapel',
	'cil'=>'CIL',
	'clojure'=>'Clojure',
	'cmake'=>'CMake',
	'cobol'=>'COBOL',
	'coffeescript'=>'CoffeeScript',
	'cpp'=>'C++',
	'cpp-qt'=>'C++ (with QT extensions)',
	'cpp-winapi'=>'C++ (WinAPI)',
	'csharp'=>'C#',
	'css'=>'CSS',
	'cuesheet'=>'Cuesheet',
	'd'=>'D',
	'dcl'=>'DCL',
	'dcpu16'=>'DCPU-16 Assembly',
	'dcs'=>'DCS',
	'delphi'=>'Delphi',
	'diff'=>'Diff-output',
	'div'=>'DIV',
	'dos'=>'DOS',
	'dot'=>'dot',
	'e'=>'E',
	'ecmascript'=>'ECMAScript',
	'eiffel'=>'Eiffel',
	'email'=>'eMail (mbox)',
	'epc'=>'EPC',
	'erlang'=>'Erlang',
	'euphoria'=>'Euphoria',
	'ezt'=>'EZT',
	'f1'=>'Formula One',
	'falcon'=>'Falcon',
	'fo'=>'FO (abas-ERP)',
	'fortran'=>'Fortran',
	'freebasic'=>'FreeBasic',
	'fsharp'=>'F#',
	'gambas'=>'GAMBAS',
	'gdb'=>'GDB',
	'genero'=>'Genero',
	'genie'=>'Genie',
	'gettext'=>'GNU Gettext',
	'glsl'=>'glSlang',
	'gml'=>'GML',
	'gnuplot'=>'GNUPlot',
	'go'=>'Go',
	'groovy'=>'Groovy',
	'gwbasic'=>'GwBasic',
	'haskell'=>'Haskell',
	'haxe'=>'Haxe',
	'hicest'=>'HicEst',
	'hq9plus'=>'HQ9+',
	'html4strict'=>'HTML 4.01',
	'html5'=>'HTML 5',
	'icon'=>'Icon',
	'idl'=>'Uno Idl',
	'ini'=>'INI',
	'inno'=>'Inno Script',
	'intercal'=>'INTERCAL',
	'io'=>'IO',
	'ispfpanel'=>'ISPF Panel',
	'j'=>'J',
	'java'=>'Java',
	'java5'=>'Java 5',
	'javascript'=>'JavaScript',
	'jcl'=>'JCL',
	'jquery'=>'jQuery',
	'kixtart'=>'KiXtart',
	'klonec'=>'KLone C',
	'klonecpp'=>'KLone C++',
	'latex'=>'LaTeX',
	'lb'=>'Liberty BASIC',
	'ldif'=>'LDIF',
	'lisp'=>'Lisp',
	'llvm'=>'LLVM',
	'locobasic'=>'Locomotive Basic',
	'logtalk'=>'Logtalk',
	'lolcode'=>'LOLcode',
	'lotusformulas'=>'Lotus Notes @Formulas',
	'lotusscript'=>'LotusScript',
	'lscript'=>'Lightwave Script',
	'lsl2'=>'Linden Script',
	'lua'=>'LUA',
	'm68k'=>'Motorola 68000 Assembler',
	'magiksf'=>'MagikSF',
	'make'=>'GNU make',
	'mapbasic'=>'MapBasic',
	'matlab'=>'Matlab M',
	'mirc'=>'mIRC Scripting',
	'mmix'=>'MMIX',
	'modula2'=>'Modula-2',
	'modula3'=>'Modula-3',
	'mpasm'=>'Microchip Assembler',
	'mxml'=>'MXML',
	'mysql'=>'MySQL',
	'nagios'=>'Nagios',
	'netrexx'=>'NetRexx',
	'newlisp'=>'NewLisp',
	'nginx'=>'Nginx',
	'nsis'=>'NSIS',
	'oberon2'=>'Oberon-2',
	'objc'=>'Objective-C',
	'objeck'=>'Objeck',
	'ocaml'=>'Ocaml',
	'ocaml-brief'=>'OCaml (Brief)',
	'octave'=>'GNU/Octave',
	'oobas'=>'OpenOffice.org Basic',
	'oorexx'=>'ooRexx',
	'oracle11'=>'Oracle 11 SQL',
	'oracle8'=>'Oracle 8 SQL',
	'oxygene'=>'Oxygene (Delphi Prism)',
	'oz'=>'OZ',
	'parasail'=>'ParaSail',
	'parigp'=>'PARI/GP',
	'pascal'=>'Pascal',
	'pcre'=>'PCRE',
	'per'=>'Per (forms)',
	'perl'=>'Perl',
	'perl6'=>'Perl 6',
	'pf'=>'OpenBSD Packet Filter',
	'php'=>'PHP',
	'php-brief'=>'PHP (Brief)',
	'pic16'=>'PIC16 Assembler',
	'pike'=>'Pike',
	'pixelbender'=>'Pixel Bender',
	'pli'=>'PL/I',
	'plsql'=>'PL/SQL',
	'postgresql'=>'PostgreSQL',
	'povray'=>'POVRAY',
	'powerbuilder'=>'PowerBuilder',
	'powershell'=>'PowerShell',
	'proftpd'=>'ProFTPd config',
	'progress'=>'Progress',
	'prolog'=>'Prolog',
	'properties'=>'Properties',
	'providex'=>'ProvideX',
	'purebasic'=>'PureBasic',
	'pycon'=>'Python (console mode)',
	'pys60'=>'Python for S60',
	'python'=>'Python',
	'qbasic'=>'QuickBASIC',
	'racket'=>'Racket',
	'rails'=>'Ruby on Rails',
	'rbs'=>'RBScript',
	'rebol'=>'REBOL',
	'reg'=>'Microsoft REGEDIT',
	'rexx'=>'Rexx',
	'robots'=>'robots.txt',
	'rpmspec'=>'RPM Specification File',
	'rsplus'=>'R / S+',
	'ruby'=>'Ruby',
	'sas'=>'SAS',
	'scala'=>'Scala',
	'scheme'=>'Scheme',
	'scilab'=>'SciLab',
	'scl'=>'SCL',
	'sdlbasic'=>'sdlBasic',
	'smalltalk'=>'Smalltalk',
	'smarty'=>'Smarty',
	'spark'=>'SPARK',
	'sparql'=>'SPARQL',
	'sql'=>'SQL',
	'stonescript'=>'StoneScript',
	'systemverilog'=>'SystemVerilog',
	'tcl'=>'TCL',
	'teraterm'=>'Tera Term Macro',
	'text'=>'Plain Text',
	'thinbasic'=>'thinBasic',
	'tsql'=>'T-SQL',
	'typoscript'=>'TypoScript',
	'unicon'=>'Unicon',
	'upc'=>'UPC',
	'urbi'=>'Urbi',
	'unrealscript'=>'Unreal Script',
	'vala'=>'Vala',
	'vb'=>'Visual Basic',
	'vbnet'=>'VB.NET',
	'vbscript'=>'VB Script',
	'vedit'=>'Vedit Macro',
	'verilog'=>'Verilog',
	'vhdl'=>'VHDL',
	'vim'=>'Vim',
	'visualfoxpro'=>'Visual FoxPro',
	'visualprolog'=>'Visual Prolog',
	'whitespace'=>'Whitespace',
	'whois'=>'WHOIS (RPSL format)',
	'winbatch'=>'WinBatch',
	'xbasic'=>'XBasic',
	'xml'=>'XML',
	'xorg_conf'=>'Xorg Config',
	'xpp'=>'X++',
	'yaml'=>'YAML',
	'z80'=>'ZiLOG Z80 Assembler',
	'zxbasic'=>'ZXBasic',
);

// The formats that are listed first.
$CONF['popular_formats']=array(
	'text','diff','html4strict','html5','css','javascript','php',
	'perl','python','postgresql','sql','ruby','rails','tcl','xml',
	'whois','xorg_conf','java','apt_sources','c','csharp','cpp',
);

/*
You're not advised to change this if you don't have any JS experience.
The new default theme will take care of this for you (a button to append the highlight prefix to selected lines)
But, we've kept this here if you wish to change the prefix, you can change the values located in paste.js on function highlight(e)
Don't forget to change 11 (the length of the default prefix) to the new length of the prefix you wish to use.
-->*/ $CONF['highlight_prefix']='!highlight!';

$CONF['diff_url']='';
// END OF CONFIGURATION FILE
?>
