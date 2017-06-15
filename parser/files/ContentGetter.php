<?php
namespace Project\files;
class ContentGetter
{
	protected $url;
	protected $file;
	protected $content = "";
	
	public function __construct ($url, $file)
	{
		$this->url = $url;
		$this->file = $file;
	}
	
	public function getContent () {
		$ch = curl_init ();
		curl_setopt_array ($ch, array(
				CURLOPT_URL => $this->url,
				CURLOPT_RETURNTRANSFER =>1,
                CURLOPT_HEADER => 0));
		$this->content = iconv('CP1251', 'UTF-8', curl_exec($ch));
		curl_close($ch);
		return $this->content;
	}
	
	public function saveContent () {
		file_put_contents ($this->file, $this->content);
	}
}