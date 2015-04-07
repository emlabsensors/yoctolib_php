<?php
/*********************************************************************
 *
 * $Id: yocto_cellular.php 19727 2015-03-13 16:22:10Z mvuilleu $
 *
 * Implements YCellular, the high-level API for Cellular functions
 *
 * - - - - - - - - - License information: - - - - - - - - -
 *
 *  Copyright (C) 2011 and beyond by Yoctopuce Sarl, Switzerland.
 *
 *  Yoctopuce Sarl (hereafter Licensor) grants to you a perpetual
 *  non-exclusive license to use, modify, copy and integrate this
 *  file into your software for the sole purpose of interfacing
 *  with Yoctopuce products.
 *
 *  You may reproduce and distribute copies of this file in
 *  source or object form, as long as the sole purpose of this
 *  code is to interface with Yoctopuce products. You must retain
 *  this notice in the distributed source file.
 *
 *  You should refer to Yoctopuce General Terms and Conditions
 *  for additional information regarding your rights and
 *  obligations.
 *
 *  THE SOFTWARE AND DOCUMENTATION ARE PROVIDED 'AS IS' WITHOUT
 *  WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING
 *  WITHOUT LIMITATION, ANY WARRANTY OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. IN NO
 *  EVENT SHALL LICENSOR BE LIABLE FOR ANY INCIDENTAL, SPECIAL,
 *  INDIRECT OR CONSEQUENTIAL DAMAGES, LOST PROFITS OR LOST DATA,
 *  COST OF PROCUREMENT OF SUBSTITUTE GOODS, TECHNOLOGY OR
 *  SERVICES, ANY CLAIMS BY THIRD PARTIES (INCLUDING BUT NOT
 *  LIMITED TO ANY DEFENSE THEREOF), ANY CLAIMS FOR INDEMNITY OR
 *  CONTRIBUTION, OR OTHER SIMILAR COSTS, WHETHER ASSERTED ON THE
 *  BASIS OF CONTRACT, TORT (INCLUDING NEGLIGENCE), BREACH OF
 *  WARRANTY, OR OTHERWISE.
 *
 *********************************************************************/

//--- (generated code: YCellRecord return codes)
//--- (end of generated code: YCellRecord return codes)
//--- (generated code: YCellRecord definitions)
//--- (end of generated code: YCellRecord definitions)

//--- (generated code: YCellRecord declaration)
/**
 * YCellRecord Class: Description of a cellular antenna
 *
 *
 */
class YCellRecord
{
    //--- (end of generated code: YCellRecord declaration)

    //--- (generated code: YCellRecord attributes)
    protected $_oper                     = "";                           // str
    protected $_mcc                      = 0;                            // int
    protected $_mnc                      = 0;                            // int
    protected $_lac                      = 0;                            // int
    protected $_cid                      = 0;                            // int
    protected $_dbm                      = 0;                            // int
    protected $_tad                      = 0;                            // int
    //--- (end of generated code: YCellRecord attributes)

    function __construct($int_mcc, $int_mnc, $int_lac, $int_cellId, $int_dbm, $int_tad, $str_oper)
    {
        //--- (generated code: YCellRecord constructor)
        //--- (end of generated code: YCellRecord constructor)
        $this->_oper = $str_oper;
        $this->_mcc = $int_mcc;
        $this->_mnc = $int_mnc;
        $this->_lac = $int_lac;
        $this->_cid = $int_cellId;
        $this->_dbm = $int_dbm;
        $this->_tad = $int_tad;
    }

    //--- (generated code: YCellRecord implementation)

    public function get_cellOperator()
    {
        return $this->_oper;
    }

    public function get_mobileCountryCode()
    {
        return $this->_mcc;
    }

    public function get_mobileNetworkCode()
    {
        return $this->_mnc;
    }

    public function get_locationAreaCode()
    {
        return $this->_lac;
    }

    public function get_cellId()
    {
        return $this->_cid;
    }

    public function get_signalStrength()
    {
        return $this->_dbm;
    }

    public function get_timingAdvance()
    {
        return $this->_tad;
    }

    //--- (end of generated code: YCellRecord implementation)

};

//--- (generated code: CellRecord functions)

//--- (end of generated code: CellRecord functions)

//--- (generated code: YCellular return codes)
//--- (end of generated code: YCellular return codes)
//--- (generated code: YCellular definitions)
if(!defined('Y_ENABLEDATA_HOMENETWORK'))     define('Y_ENABLEDATA_HOMENETWORK',    0);
if(!defined('Y_ENABLEDATA_ROAMING'))         define('Y_ENABLEDATA_ROAMING',        1);
if(!defined('Y_ENABLEDATA_NEVER'))           define('Y_ENABLEDATA_NEVER',          2);
if(!defined('Y_ENABLEDATA_INVALID'))         define('Y_ENABLEDATA_INVALID',        -1);
if(!defined('Y_LINKQUALITY_INVALID'))        define('Y_LINKQUALITY_INVALID',       YAPI_INVALID_UINT);
if(!defined('Y_CELLOPERATOR_INVALID'))       define('Y_CELLOPERATOR_INVALID',      YAPI_INVALID_STRING);
if(!defined('Y_MESSAGE_INVALID'))            define('Y_MESSAGE_INVALID',           YAPI_INVALID_STRING);
if(!defined('Y_PIN_INVALID'))                define('Y_PIN_INVALID',               YAPI_INVALID_STRING);
if(!defined('Y_LOCKEDOPERATOR_INVALID'))     define('Y_LOCKEDOPERATOR_INVALID',    YAPI_INVALID_STRING);
if(!defined('Y_APN_INVALID'))                define('Y_APN_INVALID',               YAPI_INVALID_STRING);
if(!defined('Y_APNSECRET_INVALID'))          define('Y_APNSECRET_INVALID',         YAPI_INVALID_STRING);
if(!defined('Y_COMMAND_INVALID'))            define('Y_COMMAND_INVALID',           YAPI_INVALID_STRING);
//--- (end of generated code: YCellular definitions)

//--- (generated code: YCellular declaration)
/**
 * YCellular Class: Cellular function interface
 *
 * YCellular functions provides control over cellular network parameters
 * and status for devices that are GSM-enabled.
 */
class YCellular extends YFunction
{
    const LINKQUALITY_INVALID            = YAPI_INVALID_UINT;
    const CELLOPERATOR_INVALID           = YAPI_INVALID_STRING;
    const MESSAGE_INVALID                = YAPI_INVALID_STRING;
    const PIN_INVALID                    = YAPI_INVALID_STRING;
    const LOCKEDOPERATOR_INVALID         = YAPI_INVALID_STRING;
    const ENABLEDATA_HOMENETWORK         = 0;
    const ENABLEDATA_ROAMING             = 1;
    const ENABLEDATA_NEVER               = 2;
    const ENABLEDATA_INVALID             = -1;
    const APN_INVALID                    = YAPI_INVALID_STRING;
    const APNSECRET_INVALID              = YAPI_INVALID_STRING;
    const COMMAND_INVALID                = YAPI_INVALID_STRING;
    //--- (end of generated code: YCellular declaration)

    //--- (generated code: YCellular attributes)
    protected $_linkQuality              = Y_LINKQUALITY_INVALID;        // Percent
    protected $_cellOperator             = Y_CELLOPERATOR_INVALID;       // Text
    protected $_message                  = Y_MESSAGE_INVALID;            // Text
    protected $_pin                      = Y_PIN_INVALID;                // PinPassword
    protected $_lockedOperator           = Y_LOCKEDOPERATOR_INVALID;     // Text
    protected $_enableData               = Y_ENABLEDATA_INVALID;         // ServiceScope
    protected $_apn                      = Y_APN_INVALID;                // Text
    protected $_apnSecret                = Y_APNSECRET_INVALID;          // APNPassword
    protected $_command                  = Y_COMMAND_INVALID;            // Text
    //--- (end of generated code: YCellular attributes)

    function __construct($str_func)
    {
        //--- (generated code: YCellular constructor)
        parent::__construct($str_func);
        $this->_className = 'Cellular';

        //--- (end of generated code: YCellular constructor)
    }

    //--- (generated code: YCellular implementation)

    function _parseAttr($name, $val)
    {
        switch($name) {
        case 'linkQuality':
            $this->_linkQuality = intval($val);
            return 1;
        case 'cellOperator':
            $this->_cellOperator = $val;
            return 1;
        case 'message':
            $this->_message = $val;
            return 1;
        case 'pin':
            $this->_pin = $val;
            return 1;
        case 'lockedOperator':
            $this->_lockedOperator = $val;
            return 1;
        case 'enableData':
            $this->_enableData = intval($val);
            return 1;
        case 'apn':
            $this->_apn = $val;
            return 1;
        case 'apnSecret':
            $this->_apnSecret = $val;
            return 1;
        case 'command':
            $this->_command = $val;
            return 1;
        }
        return parent::_parseAttr($name, $val);
    }

    /**
     * Returns the link quality, expressed in percent.
     *
     * @return an integer corresponding to the link quality, expressed in percent
     *
     * On failure, throws an exception or returns Y_LINKQUALITY_INVALID.
     */
    public function get_linkQuality()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_LINKQUALITY_INVALID;
            }
        }
        return $this->_linkQuality;
    }

    /**
     * Returns the name of the cell operator currently in use.
     *
     * @return a string corresponding to the name of the cell operator currently in use
     *
     * On failure, throws an exception or returns Y_CELLOPERATOR_INVALID.
     */
    public function get_cellOperator()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_CELLOPERATOR_INVALID;
            }
        }
        return $this->_cellOperator;
    }

    /**
     * Returns the latest status message from the wireless interface.
     *
     * @return a string corresponding to the latest status message from the wireless interface
     *
     * On failure, throws an exception or returns Y_MESSAGE_INVALID.
     */
    public function get_message()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_MESSAGE_INVALID;
            }
        }
        return $this->_message;
    }

    /**
     * Returns an opaque string if a PIN code has been configured in the device to access
     * the SIM card, or an empty string if none has been configured or if the code provided
     * was rejected by the SIM card.
     *
     * @return a string corresponding to an opaque string if a PIN code has been configured in the device to access
     *         the SIM card, or an empty string if none has been configured or if the code provided
     *         was rejected by the SIM card
     *
     * On failure, throws an exception or returns Y_PIN_INVALID.
     */
    public function get_pin()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_PIN_INVALID;
            }
        }
        return $this->_pin;
    }

    /**
     * Changes the PIN code used by the module to access the SIM card.
     * This function does not change the code on the SIM card itself, but only changes
     * the parameter used by the device to try to get access to it. If the SIM code
     * does not work immediately on first try, it will be automatically forgotten
     * and the message will be set to "Enter SIM PIN". The method should then be
     * invoked again with right correct PIN code. After three failed attempts in a row,
     * the message is changed to "Enter SIM PUK" and the SIM card PUK code must be
     * provided using method sendPUK.
     *
     * Remember to call the saveToFlash() method of the module to save the
     * new value in the device flash.
     *
     * @param newval : a string corresponding to the PIN code used by the module to access the SIM card
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_pin($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("pin",$rest_val);
    }

    /**
     * Returns the name of the only cell operator to use if automatic choice is disabled,
     * or an empty string if the SIM card will automatically choose among available
     * cell operators.
     *
     * @return a string corresponding to the name of the only cell operator to use if automatic choice is disabled,
     *         or an empty string if the SIM card will automatically choose among available
     *         cell operators
     *
     * On failure, throws an exception or returns Y_LOCKEDOPERATOR_INVALID.
     */
    public function get_lockedOperator()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_LOCKEDOPERATOR_INVALID;
            }
        }
        return $this->_lockedOperator;
    }

    /**
     * Changes the name of the cell operator to be used. If the name is an empty
     * string, the choice will be made automatically based on the SIM card. Otherwise,
     * the selected operator is the only one that will be used.
     *
     * @param newval : a string corresponding to the name of the cell operator to be used
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_lockedOperator($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("lockedOperator",$rest_val);
    }

    /**
     * Returns the condition for enabling IP data services (GPRS).
     * When data services are disabled, SMS are the only mean of communication.
     *
     * @return a value among Y_ENABLEDATA_HOMENETWORK, Y_ENABLEDATA_ROAMING and Y_ENABLEDATA_NEVER
     * corresponding to the condition for enabling IP data services (GPRS)
     *
     * On failure, throws an exception or returns Y_ENABLEDATA_INVALID.
     */
    public function get_enableData()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_ENABLEDATA_INVALID;
            }
        }
        return $this->_enableData;
    }

    /**
     * Changes the condition for enabling IP data services (GPRS).
     * The service can be either fully deactivated, or limited to the SIM home network,
     * or enabled for all partner networks (roaming). Caution: enabling data services
     * on roaming networks may cause prohibitive communication costs !
     *
     * When data services are disabled, SMS are the only mean of communication.
     *
     * @param newval : a value among Y_ENABLEDATA_HOMENETWORK, Y_ENABLEDATA_ROAMING and Y_ENABLEDATA_NEVER
     * corresponding to the condition for enabling IP data services (GPRS)
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_enableData($newval)
    {
        $rest_val = strval($newval);
        return $this->_setAttr("enableData",$rest_val);
    }

    /**
     * Returns the Access Point Name (APN) to be used, if needed.
     * When left blank, the APN suggested by the cell operator will be used.
     *
     * @return a string corresponding to the Access Point Name (APN) to be used, if needed
     *
     * On failure, throws an exception or returns Y_APN_INVALID.
     */
    public function get_apn()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_APN_INVALID;
            }
        }
        return $this->_apn;
    }

    /**
     * Returns the Access Point Name (APN) to be used, if needed.
     * When left blank, the APN suggested by the cell operator will be used.
     *
     * @param newval : a string
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_apn($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("apn",$rest_val);
    }

    /**
     * Returns an opaque string if APN authentication parameters have been configured
     * in the device, or an empty string otherwise.
     * To configure these parameters, use set_apnAuth().
     *
     * @return a string corresponding to an opaque string if APN authentication parameters have been configured
     *         in the device, or an empty string otherwise
     *
     * On failure, throws an exception or returns Y_APNSECRET_INVALID.
     */
    public function get_apnSecret()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_APNSECRET_INVALID;
            }
        }
        return $this->_apnSecret;
    }

    public function set_apnSecret($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("apnSecret",$rest_val);
    }

    public function get_command()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_COMMAND_INVALID;
            }
        }
        return $this->_command;
    }

    public function set_command($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("command",$rest_val);
    }

    /**
     * Retrieves a cellular interface for a given identifier.
     * The identifier can be specified using several formats:
     * <ul>
     * <li>FunctionLogicalName</li>
     * <li>ModuleSerialNumber.FunctionIdentifier</li>
     * <li>ModuleSerialNumber.FunctionLogicalName</li>
     * <li>ModuleLogicalName.FunctionIdentifier</li>
     * <li>ModuleLogicalName.FunctionLogicalName</li>
     * </ul>
     *
     * This function does not require that the cellular interface is online at the time
     * it is invoked. The returned object is nevertheless valid.
     * Use the method YCellular.isOnline() to test if the cellular interface is
     * indeed online at a given time. In case of ambiguity when looking for
     * a cellular interface by logical name, no error is notified: the first instance
     * found is returned. The search is performed first by hardware name,
     * then by logical name.
     *
     * @param func : a string that uniquely characterizes the cellular interface
     *
     * @return a YCellular object allowing you to drive the cellular interface.
     */
    public static function FindCellular($func)
    {
        // $obj                    is a YCellular;
        $obj = YFunction::_FindFromCache('Cellular', $func);
        if ($obj == null) {
            $obj = new YCellular($func);
            YFunction::_AddToCache('Cellular', $func, $obj);
        }
        return $obj;
    }

    /**
     * Sends a PUK code to unlock the SIM card after three failed PIN code attempts, and
     * setup a new PIN into the SIM card. Only ten consecutives tentatives are permitted:
     * after that, the SIM card will be blocked permanently without any mean of recovery
     * to use it again. Note that after calling this method, you have usually to invoke
     * method set_pin() to tell the YoctoHub which PIN to use in the future.
     *
     * @param puk : the SIM PUK code
     * @param newPin : new PIN code to configure into the SIM card
     *
     * @return YAPI_SUCCESS when the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function sendPUK($puk,$newPin)
    {
        // $gsmMsg                 is a str;
        
        $gsmMsg = $this->get_message();
        if (!($gsmMsg == 'Enter SIM PUK')) return $this->_throw(YAPI_INVALID_ARGUMENT, 'PUK not expected at $this time',YAPI_INVALID_ARGUMENT);
        if ($newPin == '') {
            return $this->set_command(sprintf('AT+CPIN=%s,0000;+CLCK=SC,0,0000',$puk));
        }
        return $this->set_command(sprintf('AT+CPIN=%s,%s',$puk,$newPin));
    }

    /**
     * Configure authentication parameters to connect to the APN. Both
     * PAP and CHAP authentication are supported.
     *
     * @param username : APN username
     * @param password : APN password
     *
     * @return YAPI_SUCCESS when the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_apnAuth($username,$password)
    {
        return $this->set_apnSecret(sprintf('%s,%s',$username,$password));
    }

    /**
     * Sends an AT command to the GSM module and returns the command output.
     * The command will only execute when the GSM module is in standard
     * command state, and should leave it in the exact same state.
     * Use this function with great care !
     *
     * @param cmd : the AT command to execute, like for instance: "+CCLK?".
     *
     * @return a string with the result of the commands. Empty lines are
     *         automatically removed from the output.
     */
    public function _AT($cmd)
    {
        // $chrPos                 is a int;
        // $cmdLen                 is a int;
        // $content                is a bin;
        // quote dangerous characters used in AT commands
        $cmdLen = strlen($cmd);
        $chrPos = Ystrpos($cmd,'#');
        while ($chrPos >= 0) {
            $cmd = sprintf('%s%c23%s', substr($cmd,  0, $chrPos), 37,
            substr($cmd,  $chrPos+1, $cmdLen-$chrPos-1));
            $cmdLen = $cmdLen + 2;
            $chrPos = Ystrpos($cmd,'#');
        }
        $chrPos = Ystrpos($cmd,'+');
        while ($chrPos >= 0) {
            $cmd = sprintf('%s%c2B%s', substr($cmd,  0, $chrPos), 37,
            substr($cmd,  $chrPos+1, $cmdLen-$chrPos-1));
            $cmdLen = $cmdLen + 2;
            $chrPos = Ystrpos($cmd,'+');
        }
        $chrPos = Ystrpos($cmd,'=');
        while ($chrPos >= 0) {
            $cmd = sprintf('%s%c3D%s', substr($cmd,  0, $chrPos), 37,
            substr($cmd,  $chrPos+1, $cmdLen-$chrPos-1));
            $cmdLen = $cmdLen + 2;
            $chrPos = Ystrpos($cmd,'=');
        }
        
        // may throw an exception
        $content = $this->_download(sprintf('at.txt?cmd=%s',$cmd));
        return $content;
    }

    /**
     * Returns a list of nearby cellular antennas, as required for quick
     * geolocation of the device. The first cell listed is the serving
     * cell, and the next ones are the neighboor cells reported by the
     * serving cell.
     *
     * @return a list of YCellRecords.
     */
    public function quickCellSurvey()
    {
        // $moni                   is a str;
        $recs = Array();        // strArr;
        // $llen                   is a int;
        // $mccs                   is a str;
        // $mcc                    is a int;
        // $mncs                   is a str;
        // $mnc                    is a int;
        // $lac                    is a int;
        // $cellId                 is a int;
        // $dbms                   is a str;
        // $dbm                    is a int;
        // $tads                   is a str;
        // $tad                    is a int;
        // $oper                   is a str;
        $res = Array();         // YCellRecordArr;
        // may throw an exception
        $moni = $this->_AT('+CCED=0;#MONI=7;#MONI');
        $mccs = substr($moni, 7, 3);
        if (substr($mccs, 0, 1) == '0') {
            $mccs = substr($mccs, 1, 2);
        }
        if (substr($mccs, 0, 1) == '0') {
            $mccs = substr($mccs, 1, 1);
        }
        $mcc = intVal($mccs);
        $mncs = substr($moni, 11, 3);
        if (substr($mncs, 2, 1) == ',') {
            $mncs = substr($mncs, 0, 2);
        }
        if (substr($mncs, 0, 1) == '0') {
            $mncs = substr($mncs, 1, strlen($mncs)-1);
        }
        $mnc = intVal($mncs);
        $recs = explode('#', $moni);
        // process each line in turn
        while(sizeof($res) > 0) { array_pop($res); };
        foreach($recs as $each) {
            $llen = strlen($each) - 2;
            if ($llen >= 44) {
                if (substr($each, 41, 3) == 'dbm') {
                    $lac = hexdec(substr($each, 16, 4));
                    $cellId = hexdec(substr($each, 23, 4));
                    $dbms = substr($each, 37, 4);
                    if (substr($dbms, 0, 1) == ' ') {
                        $dbms = substr($dbms, 1, 3);
                    }
                    $dbm = intVal($dbms);
                    if ($llen > 66) {
                        $tads = substr($each, 54, 2);
                        if (substr($tads, 0, 1) == ' ') {
                            $tads = substr($tads, 1, 3);
                        }
                        $tad = intVal($tads);
                        $oper = substr($each, 66, $llen-66);
                    } else {
                        $tad = -1;
                        $oper = '';
                    }
                    if ($lac < 65535) {
                        $res[] = new YCellRecord($mcc, $mnc, $lac, $cellId, $dbm, $tad, $oper);
                    }
                }
            }
        }
        return $res;
    }

    public function linkQuality()
    { return $this->get_linkQuality(); }

    public function cellOperator()
    { return $this->get_cellOperator(); }

    public function message()
    { return $this->get_message(); }

    public function pin()
    { return $this->get_pin(); }

    public function setPin($newval)
    { return $this->set_pin($newval); }

    public function lockedOperator()
    { return $this->get_lockedOperator(); }

    public function setLockedOperator($newval)
    { return $this->set_lockedOperator($newval); }

    public function enableData()
    { return $this->get_enableData(); }

    public function setEnableData($newval)
    { return $this->set_enableData($newval); }

    public function apn()
    { return $this->get_apn(); }

    public function setApn($newval)
    { return $this->set_apn($newval); }

    public function apnSecret()
    { return $this->get_apnSecret(); }

    public function setApnSecret($newval)
    { return $this->set_apnSecret($newval); }

    public function command()
    { return $this->get_command(); }

    public function setCommand($newval)
    { return $this->set_command($newval); }

    /**
     * Continues the enumeration of cellular interfaces started using yFirstCellular().
     *
     * @return a pointer to a YCellular object, corresponding to
     *         a cellular interface currently online, or a null pointer
     *         if there are no more cellular interfaces to enumerate.
     */
    public function nextCellular()
    {   $resolve = YAPI::resolveFunction($this->_className, $this->_func);
        if($resolve->errorType != YAPI_SUCCESS) return null;
        $next_hwid = YAPI::getNextHardwareId($this->_className, $resolve->result);
        if($next_hwid == null) return null;
        return yFindCellular($next_hwid);
    }

    /**
     * Starts the enumeration of cellular interfaces currently accessible.
     * Use the method YCellular.nextCellular() to iterate on
     * next cellular interfaces.
     *
     * @return a pointer to a YCellular object, corresponding to
     *         the first cellular interface currently online, or a null pointer
     *         if there are none.
     */
    public static function FirstCellular()
    {   $next_hwid = YAPI::getFirstHardwareId('Cellular');
        if($next_hwid == null) return null;
        return self::FindCellular($next_hwid);
    }

    //--- (end of generated code: YCellular implementation)

};

//--- (generated code: Cellular functions)

/**
 * Retrieves a cellular interface for a given identifier.
 * The identifier can be specified using several formats:
 * <ul>
 * <li>FunctionLogicalName</li>
 * <li>ModuleSerialNumber.FunctionIdentifier</li>
 * <li>ModuleSerialNumber.FunctionLogicalName</li>
 * <li>ModuleLogicalName.FunctionIdentifier</li>
 * <li>ModuleLogicalName.FunctionLogicalName</li>
 * </ul>
 *
 * This function does not require that the cellular interface is online at the time
 * it is invoked. The returned object is nevertheless valid.
 * Use the method YCellular.isOnline() to test if the cellular interface is
 * indeed online at a given time. In case of ambiguity when looking for
 * a cellular interface by logical name, no error is notified: the first instance
 * found is returned. The search is performed first by hardware name,
 * then by logical name.
 *
 * @param func : a string that uniquely characterizes the cellular interface
 *
 * @return a YCellular object allowing you to drive the cellular interface.
 */
function yFindCellular($func)
{
    return YCellular::FindCellular($func);
}

/**
 * Starts the enumeration of cellular interfaces currently accessible.
 * Use the method YCellular.nextCellular() to iterate on
 * next cellular interfaces.
 *
 * @return a pointer to a YCellular object, corresponding to
 *         the first cellular interface currently online, or a null pointer
 *         if there are none.
 */
function yFirstCellular()
{
    return YCellular::FirstCellular();
}

//--- (end of generated code: Cellular functions)
?>