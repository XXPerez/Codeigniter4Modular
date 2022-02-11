<?php 
namespace Utils\Controllers;
use CodeIgniter\Controller;

class Language extends Controller
{
    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        session()->set('skip_debug',true); 
      
    }
    
    /**
     * @return View
     */
    public function setLang($module='Home', $file='General')
    {
        $this->response->setContentType('Content-Type: application/javascript');
        $module = ucfirst(preg_replace('/[^a-zA-Z]/','',$module));
        $file = ucfirst(preg_replace('/[^a-zA-Z]/','',$file));
        if ($file=='') {
            $file=$module;
        }
        $newStrings = $this->getModuleLang($module, $file);
        
        return " if(!strLang) var strLang = {}; strLang.".strtolower($module)." = ". json_encode($newStrings).";\n";
        
    }
    
    protected function getModuleLang($module, $file) {
        $newStrings = array();
        $lang = $this->request->getLocale();
        $languageFilePath = APPPATH . "Modules/$module/Language/$lang/$file.php";
        if (file_exists($languageFilePath)) {
            $strings = include $languageFilePath;

            foreach ($strings as $key => $val) {
                $key = str_replace('-','',$key);
                $key = str_replace('.','',$key);
                $newStrings[$key] = addslashes($val);
            }
        }        
        return $newStrings;
    }
}
