<?php

class i18n {

    /**
     * Language file path
     * This is the path for the language files. You must use the '{LANGUAGE}' placeholder for the language or the script wont find any language files.
     *
     * @var string
     */
    protected $filePath = './lang/lang_{LANGUAGE}.ini';

    /**
     * Default language
     * This is the language which is used when there is no language file for all other user languages. It has the lowest priority.
     *
     * @var string
     */
    protected $defaultLang = 'en';

    /**
     * Forced language
     * If you want to force a specific language define it here.
     *
     * @var string
     */
    protected $forcedLang = NULL;

    /*
     * The following properties are only available after calling init().
     */

    /**
     * User languages
     * These are the languages the user uses.
     * Normally, if you use the getUserLangs-method this array will be filled in like this:
     * 1. Forced language
     * 2. Language in $_GET['lang']
     * 3. Language in $_SESSION['lang']
     * 4. Languages in browser
     * 5. Default language
     *
     * @var array
     */
    protected $userLangs = array();
    protected $appliedLang = NULL;
    protected $langFile = NULL;
    protected $defaultLangFile = NULL;

/**
     * Constructor
     * The constructor defines the language to use.
     *
     */
    public function __construct() {
        $this->userLangs = $this->getUserLangs();

        // search for language file
        $this->appliedLang = NULL;
        foreach ($this->userLangs as $priority => $langcode) {
            $langFilePath = str_replace('{LANGUAGE}', $langcode, $this->filePath);
            if (file_exists($langFilePath)) {
                $this->appliedLang = $langcode;
                $this->langFile = parse_ini_file($langFilePath, true);
                $_SESSION['lang'] = $langcode;
                break;
            }
        }
        if ($this->appliedLang == NULL) {
            throw new RuntimeException('No language file was found.');
        }

        // initialization of default language file
        $defaultLangFilePath = str_replace('{LANGUAGE}', $this->defaultLang, $this->filePath);
        $this->defaultLangFile = parse_ini_file($defaultLangFilePath, true);

    }

    public function getAppliedLang() {
        return $this->appliedLang;
    }

    /**
     * getUserLangs()
     * Returns the user languages
     * Normally it returns an array like this:
     * 1. Forced language
     * 2. Language in $_GET['lang']
     * 3. Language in $_SESSION['lang']
     * 4. HTTP_ACCEPT_LANGUAGE
     * 5. Default language
     * Note: duplicate values are deleted.
     *
     * @return array with the user languages sorted by priority.
     */
    public function getUserLangs() {
        $userLangs = array();

        // Highest priority: forced language
        if ($this->forcedLang != NULL) {
            $userLangs[] = $this->forcedLang;
        }

        // 2nd highest priority: GET parameter 'lang'
        if (isset($_GET['lang']) && is_string($_GET['lang'])) {
            $userLangs[] = $_GET['lang'];
        }

        // 3rd highest priority: SESSION parameter 'lang'
        if (isset($_SESSION['lang']) && is_string($_SESSION['lang'])) {
            $userLangs[] = $_SESSION['lang'];
        }

        // 4th highest priority: HTTP_ACCEPT_LANGUAGE
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            foreach (explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $part) {
                $userLangs[] = strtolower(substr($part, 0, 2));
            }
        }

        // 5th highest priority: default
        $userLangs[] = $this->defaultLang;

        // remove duplicate elements
        $userLangs = array_unique($userLangs);

        foreach ($userLangs as $key => $value) {
            $userLangs[$key] = preg_replace('/[^a-zA-Z0-9_-]/', '', $value); // only allow a-z, A-Z and 0-9
        }

        return $userLangs;
    }

    public function translate($message){
        $result="";
        if (isset($this->langFile["server"][$message])){
            $result= $this->langFile["server"][$message];
        }
        else{
            if (isset($this->defaultLangFile["server"][$message])){
                $result= $this->defaultLangFile["server"][$message];
            }
        }
        return $result;
    }

    public function getJsonLang($side){
        return json_encode($this->langFile[$side]);        
    }

}
?>