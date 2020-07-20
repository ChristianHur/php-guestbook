<?php
class Content{
    private $key;
    private $content;

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}


class Page
{
    private $title;
    private $css;
    private $scripts;
    private $css_dir;
    private $scripts_dir;
    private $content=[];

    public function __construct($title='Sample Page',$css='',$scripts='',$css_dir='css',$scripts_dir='scripts')
    {
        $this->setTitle($title);
        $this->setCss($css);
        $this->setScripts($scripts);
        $this->setCssDir($css_dir);
        $this->setScriptsDir($scripts_dir);
    }

    function setupHTML(){
        $html = "
        <!DOCTYPE html>
        <html>
          <head>
            <title>".$this->getTitle()."</title>
            ";
        if($this->getScripts()){
            $html .= "<script src='".$this->getScriptsDir()."/".$this->getScripts()."'></script>";
        }
        if($this->getCss()){
            $html .= "<link href='".$this->getCssDir()."/".$this->getCss()."' rel='stylesheet'>";
        }

    $html .= "
          </head>
          <body>";

        foreach ($this->getContent() as $key=>$content){
            $html .= $content;
        }

        $html .="
          </body>
        </html>
        ";
        return $html;
    }

    function getContent($key=null){
        if($key) return $this->content[$key];
        return $this->content;
    }

    function setContent($key,$content){
        $this->content[$key] = $content;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param mixed $css
     */
    public function setCss($css)
    {
        $this->css = $css;
    }

    /**
     * @return mixed
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @param mixed $scripts
     */
    public function setScripts($scripts)
    {
        $this->scripts = $scripts;
    }

    /**
     * @return mixed
     */
    public function getCssDir()
    {
        return $this->css_dir;
    }

    /**
     * @param mixed $css_dir
     */
    public function setCssDir($css_dir)
    {
        $this->css_dir = $css_dir;
    }

    /**
     * @return mixed
     */
    public function getScriptsDir()
    {
        return $this->scripts_dir;
    }

    /**
     * @param mixed $scripts_dir
     */
    public function setScriptsDir($scripts_dir)
    {
        $this->scripts_dir = $scripts_dir;
    }
}


