<?php
require_once 'simple_html_dom.php';
require_once("./phpQuery-onefile.php");
header('Content-Type: text/html; charset=UTF-8');
// header('content-type: application/json; charset=utf-8');
//URLの取得 URLがない場合エラー
if(!isset($_GET['url'])){
  echo "url not set";
  statusFailure();
}
$url = $_GET['url'];

//PhantomJSの実行
$cmd = '/usr/local/bin/phantomjs phantomjs-get-html.js ' . $url;
exec($cmd, $arr, $ret);

//データがない場合エラー
if(!$arr){
  echo "data is empty\n";
  statusFailure();
}

//var_dump("data is exit");
//var_dump($arr);

//文字列結合
  $html = '';
foreach($arr as $val){
    //var_dump($val);
    $html .= $val;
  }

//JSONにてHTMLを出力
  $jsonstr = json_encode([
    'status' => 'success',
    'html' => $html
    ]);
  $json = json_decode($jsonstr, true);
  $html_arr = str_get_html($json['html']);
  $html_arr->clear();
//  var_dump($html_arr);

  foreach($html_arr as $htmlProps => $htmlPropsVal){
    if ($htmlProps === "nodes") {
      foreach($htmlPropsVal as $simpleHtmlDomNode) {
        foreach($simpleHtmlDomNode as $key => $val) {
          foreach((array)$val as $kind => $kindVal) {
              if (($kind === "class")&&(strpos($kindVal, "topics transition clearfix") !== false)){
                  $href = $url.$val["href"];
                  $html = file_get_contents($href);
                  $h2 = phpQuery::newDocument($html)->find(".container")->find(".inner")->find("h2:eq(1)")->text();
                  preg_match('|\d{4}\/\d{1,2}\/\d{1,2}|', $h2, $data);
                  var_dump($data);
                  $title = str_replace($data, '', $h2);
                  var_dump($title);
                  $mainText = phpQuery::newDocument($html)->find(".container")->find(".inner")->find(".newsTxt")->text();
                  var_dump($mainText);
                  $imgTag = phpQuery::newDocument($html)->find(".container")->find(".inner")->find("li:eq(6)");
                  $pattern="/(?<=<img\s).*?src=([\"'])(.+?)\\1/i";
                  preg_match($pattern,$imgTag,$img);
                  echo '<img src="http://www.lumine.ne.jp'.$img[2].'"/>';
                  echo '</br>';
              }
          }
        }
      }
    }
  }

//エラー出力関数
  function statusFailure(){
    echo json_encode([
      'status' => 'failure',
      'html' => ''
    ]);
    die();
  }
?>
