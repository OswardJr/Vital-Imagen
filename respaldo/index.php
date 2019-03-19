<?php
// SBMD - Simple Backup Mysql Database script
date_default_timezone_set('America/Caracas');
error_reporting(E_ERROR | E_PARSE);

$lang ='en';  //indice of the "lang_...json" file with texts
$dir = 'backup/';  //folder to store the ZIP archive with SQL backup

session_start();
$html = $bmd_re ='';

//set object of backupmysql class
include 'backupmysql.class.php';
$bk = new backupmysql($lang, $dir);

$frm ='<h1>'. $bk->langTxt('msg_bmk') .'</h1>
<div class="col-xs-12">
  <div class="col-xs-4 col-xs-offset-4">
    <form action="" method="post" id="">
      <div class="panel panel-default" style="margin-top:50%;">
        <div class="panel-heading">
          <center><div class="panel-title"><strong>Respaldo de la Base de datos</strong></div></center>
      </div>
      <div style="padding-top:10px" class="panel-body" >
          <div style="display:none" id="login-alert" class="alert alert-danger col-xs-12"></div>
          <div style="margin-bottom: 2px" class="input-group">
            <div class="col-xs-12">
                <h4>'. $bk->langTxt('msg_connect') .'</h4>
                '. $bk->langTxt('msg_server') .' <input type="hidden" class="form-control"  name="host" value="localhost">
            </div>
        </div>
   <div class="row">
        <div class="col-xs-12">
                '. $bk->langTxt('msg_user') .' <strong>Usuario:</strong><input type="text" class="form-control"  name="user" value="">
                <br>
                '. $bk->langTxt('msg_pass') .' <strong>Clave: </strong><input type="password" class="form-control"  name="pass" value="" >
        </div>
    </div>
        <div style="margin-bottom: 15px" class="input-group">
            <div class="col-xs-12">
                '. $bk->langTxt('msg_database') .'
                <input type="hidden" class="form-control"  value="clinica2" required="true" name="dbname">
            </div>
        </div>
            <div class=" form-group col-xs-4 col-xs-offset-4">
                <input type="submit" class="btn btn-default" value="'. $bk->langTxt('msg_send') .'" style="background:#ccc;color:#000;">
            </div>
    </div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>';
//if not form send, set form wiith fields for connection data
if((!isset($_POST) || count($_POST) ==0) && !isset($_SESSION['bmd_re'])){
    if(isset($_SESSION['mysql'])) unset($_SESSION['mysql']);
    if(isset($_SESSION['bmd_re'])) unset($_SESSION['bmd_re']);
    $html = $frm;
}
else if(isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['dbname'])){
    $_POST = array_map('trim', array_map('strip_tags', $_POST));
    $_SESSION['mysql'] = ['host'=>$_POST['host'], 'user'=>$_POST['user'], 'pass'=>$_POST['pass'], 'dbname'=>$_POST['dbname']];
}

//if session with data for connecting to MySQL database (MySQL server, user, password, database name)
if(isset($_SESSION['mysql'])){
    @set_time_limit(600);

$bk->setMysql($_SESSION['mysql']);  //set connection data

//if form with tables to backup, create ZIP archive with backup. Else: restore backup, or Delete ZIP
if(isset($_POST['tables']) || isset($_POST['bmd_zip'])){
    if(isset($_POST['tables'])) {
$tables = array_map('strip_tags', $_POST['tables']);  //store tables in object
$bmd_re = $bk->saveBkZip($tables);
}
else if(isset($_POST['bmd_zip'])){
    if(isset($_POST['file'])){
        $_POST['file'] = trim(strip_tags($_POST['file']));
        if($_POST['bmd_zip'] =='res_file') $bmd_re = $bk->restore($_POST['file']);
else if($_POST['bmd_zip'] =='get_file') $bmd_re = $bk->getZipFile($_POST['file']);  //when to get ZIP file
else if($_POST['bmd_zip'] =='del_file')$bmd_re = $bk->delFile($_POST['file']);  //when to delete ZIP
}
else $bmd_re = $bk->langTxt('er_sel_file');
}

//Keep response, Refresh to not send form-data again if refreshed
$_SESSION['bmd_re'] = $bmd_re;
header('Location: '. $_SERVER['REQUEST_URI']);
exit;
}

//get response after refresh, delete that session
if(isset($_SESSION['bmd_re'])){
    $bmd_re = $_SESSION['bmd_re'];
    unset($_SESSION['bmd_re']);
}

$html = '<div id="bmd_re">'. $bmd_re .'</div>';

$tables = $bk->getListTables();  //array with [f, er] (form, error)

//if not error when get to show tables, add form with checkboxes, else $frm
if($tables['er'] =='') $html .= '
<a href="'. $_SERVER['PHP_SELF'] .'" title="'. $bk->langTxt('msg_conn_other') .'" id="a_cd"> '. $bk->langTxt('msg_conn_other') .'<button type="button" class="btn btn-default" style="color: #c51f13;border-color:#f55544;float:right;top:12px;" id="a_cd"><strong>Salir</strong></button></a>

<h2 id="tab_frm_zip">'. $bk->langTxt('msg_show_files') .'<button type="button" style="color:#ce7902;border-color:#eea236;" class="btn btn-default"><strong>Respaldos Realizados</strong></button></h2>

<h2 id="tab_frm_cht" class="tabvi">'. $bk->langTxt('msg_show_tables') .'<button type="button" style="color:#1a8e1a;border-color:green;" class="btn btn-default"><strong>Mostrar Tablas</strong></button></h2>
<br>'. $tables['f'] . $bk->getListZip($dir);
else $html ='<div id="bmd_re">'. $tables['er'] .'</div>'. $frm;
}

//set texts that will be added in JS (in bmd_lang)
$lang_js = '{
"msg_when_del":"'. str_replace('"', '\"', $bk->langTxt('msg_when_del')) .'",
"msg_loading":"'. str_replace('"', '\"', $bk->langTxt('msg_loading')) .'"
}';

header('Content-type: text/html; charset=utf-8');
?>

<!doctype html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <meta charset="utf-8" />
    <title>Simple Backup MySQL Database</title>
    <style>

        body {
            margin:0;
            background: transparent;
            padding:0;
            text-align:center;
            font-size:14px;
            font-family:Arial;
            border: none;
        }
        
        .panel{
            border: none;
        }
        
        h1 {
            margin:2px auto;
            text-decoration:underline;
            font-size:1.4em;
        }
        h1 span {
            color:#0000eb;
            letter-spacing:1px;
        }
        h3 {
            margin:0 auto 8px auto;
            font-size:1.1em;
            text-align:left;
            padding-left:2%;
        }
        h4 {
            margin:0 auto 8px auto;
            font-size:1.1em;
        }
        label {cursor:pointer;}
        label:hover {
            background:#fefefe;
            text-decoration:underline;
            color:#e00;
        }
        button{
            color: #fff;
            background: #5bc0de;
        }
        #frm {
            width:350px;
            margin:1em auto;
            background: #fff;
            line-height:150%;
            padding:10px 10px 10px 10px;
            font-size:1.1em;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            padding: 25px 25px 25px 25px;
        }

        #get_file{
            color: #fff;
            background: #34abce;
            border-color: #46b8da;
        }
        #res_file{
            color: #fff;
            background: #34abce;
            border-color: #46b8da;
        }
        #del_file{
            color: #fff;
            background: #34abce;
            border-color: #46b8da;
        }
        #a_cd {
            display:block;
            margin:.10em 20px .5em 2px;
            text-align:right;
            font-size:1.1em;
            color:#0000eb;
        }
        #a_cd:hover {
            text-decoration:none;
            color:#0000b0;
        }

        #bmd_re {
            background:#fff;
            border:1px solid blue;
            padding:3px;
            font-weight:500;
            color:black;
        }
        #bmd_re:empty { display:none;}
        #bmd_load {
            position:fixed;
            left:0;
            top:0;
            margin:0;
            width:100%;
            height:100%;
            background:#fafabe;
            opacity:.9;
            padding:15% 1% 1% 1%;
            font-size:28px;
            font-weight:600;
            letter-spacing:1px;
            z-index:9999;
        }
        #bmd_load span {
            background:#fefefe;
            border-radius:5px;
            padding:3px;
            line-height:155%;
        }

        h2 {
            display:inline-block;
            margin:0 5px 15px 5px;
            padding:5px 5px;
            font-size:1.13em;
            letter-spacing:1px;
            cursor:pointer;
        }

        #frm_cht {
            display:inline-block;
            background:#efeffc;
            padding:0 2px 5px 2px;
        }
        #frm_cht #ch_all {
            font-weight:700;
            letter-spacing:1px;
            text-decoration:underline;
        }
        #frm_cht .ch_tables {
            display:inline-block;
            margin:8px 1px;
            text-align:left;
            vertical-align:top;
        }
        #frm_cht .ch_tables label {
            display:block;
        }

        #frm_zip {
            display:none;
            background: white;
            padding:0 4px 5px 2px;
        }
        #frm_zip label {
            display:block;
            margin:3px 1%;
            text-align:left;
        }

        #mp {
            margin:2% auto 20px auto;
            font-style:oblique;
            font-size:13px;
        }
        //-->
    </style>
</style>
</head>
<body>
    <?php echo $html; ?>
    <script>
// <![CDATA[
var bmd_lang = <?php echo $lang_js; ?>  //object with texts from $lang

//display loading message
function bmdLoading(){
  document.querySelector('body').insertAdjacentHTML('beforeend', '<div id="bmd_load"><span>'+ bmd_lang.msg_loading +'</span></div>');
}

//if clicked on #ch_all, check all tables in .ch_tables
var ch_all = document.getElementById('ch_all');
if(ch_all){
  var ch_btn = ch_all.querySelector('input');
  var tables = document.querySelectorAll('#frm_cht .ch_tables input');
  ch_all.addEventListener('click', function(){
    if(tables){
      for(var i=0; i<tables.length; i++) tables[i].checked = ch_btn.checked;
  }
});
}

//if #frm_zip
var frm_zip = document.getElementById('frm_zip');
if(frm_zip){
  var dir_bk = document.getElementById('dir_bk').value +'/';
  var zip_files = document.querySelectorAll('#frm_zip .zip_files');

  //get buttons in #frm_zip, register click to submit form according to button
  if(zip_files){
    var btn_zip = document.querySelectorAll('#frm_zip #res_file, #frm_zip #get_file, #frm_zip #del_file');
    for(var i=0; i<btn_zip.length; i++){
      btn_zip[i].addEventListener('click', function(e){
        for(var i2=0; i2<zip_files.length; i2++){
          if(zip_files[i2].checked === true){
            var conf_del = (e.target.id =='del_file') ? window.confirm(bmd_lang.msg_when_del) : true;
            if(conf_del){
              frm_zip['bmd_zip'].value = e.target.id;
              if(e.target.id !='get_file') bmdLoading();  //show Loading if not get_file request
              frm_zip.submit();
          }
          break;
      }
  }
});
  }
}

/* Tabs effect ( http://coursesweb.net/ ) */

var h2tabs = document.querySelectorAll('h2');
var frm_cht = document.getElementById('frm_cht');
  // sets active tab, hides tabs content and shows content associated to current active tab
  // receives the id of active tab
  function tabsCnt(tab_id) {
    document.querySelector('h2.tabvi').removeAttribute('class');
    document.getElementById(tab_id).setAttribute('class', 'tabvi');
    frm_zip.style.display = 'none';
    frm_cht.style.display = 'none';
    document.getElementById(tab_id.replace('tab_', '')).style.display = 'inline-block';
}

  // registers click for tabs
  for(var i=0; i<h2tabs.length; i++) h2tabs[i].addEventListener('click', function(){
    tabsCnt(this.id);
});

  //on submit forms, show Loading
  frm_cht.addEventListener('submit', bmdLoading);
  frm_zip.addEventListener('submit', bmdLoading);
}
// ]]>
</script>
</body>
</html>