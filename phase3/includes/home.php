<?php
include "page.php";

$home = new Page();
$home->setTitle('Home Page');
$home->setScripts('main.js');
$home->setCss('main.css');
$home->setContent('hello',"<h1>Hello</h1>");
$home->setContent('cool',"<h3><a href='about.php'>About</a></h3>");
$home->setContent('p1','<p>This is the story of a simple PHP page.</p>');
echo $home->setupHTML();

createPage("about","About Us");
function createPage($file_name,$title){
    $f = fopen($file_name,"w");
    $about = new Page($title);
    $about->setContent('h1',"<h1>$title</h1>");
    $about->setContent('cool',"<h3><a href='home.php'>Back Home</a></h3>");

    fwrite($f,$about->setupHTML());
    fclose($f);
}


