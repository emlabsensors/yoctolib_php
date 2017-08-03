<?php
/*********************************************************************
 *
 * $Id: yocto_weighscale.php 28231 2017-07-31 16:37:33Z mvuilleu $
 *
 * Implements YWeighScale, the high-level API for WeighScale functions
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

//--- (YWeighScale return codes)
//--- (end of YWeighScale return codes)
//--- (YWeighScale definitions)
if(!defined('Y_EXCITATION_OFF'))             define('Y_EXCITATION_OFF',            0);
if(!defined('Y_EXCITATION_DC'))              define('Y_EXCITATION_DC',             1);
if(!defined('Y_EXCITATION_AC'))              define('Y_EXCITATION_AC',             2);
if(!defined('Y_EXCITATION_INVALID'))         define('Y_EXCITATION_INVALID',        -1);
if(!defined('Y_ADAPTRATIO_INVALID'))         define('Y_ADAPTRATIO_INVALID',        YAPI_INVALID_DOUBLE);
if(!defined('Y_COMPTEMPERATURE_INVALID'))    define('Y_COMPTEMPERATURE_INVALID',   YAPI_INVALID_DOUBLE);
if(!defined('Y_COMPENSATION_INVALID'))       define('Y_COMPENSATION_INVALID',      YAPI_INVALID_DOUBLE);
if(!defined('Y_ZEROTRACKING_INVALID'))       define('Y_ZEROTRACKING_INVALID',      YAPI_INVALID_DOUBLE);
if(!defined('Y_COMMAND_INVALID'))            define('Y_COMMAND_INVALID',           YAPI_INVALID_STRING);
//--- (end of YWeighScale definitions)

//--- (YWeighScale declaration)
/**
 * YWeighScale Class: WeighScale function interface
 *
 * The YWeighScale class provides a weight measurement from a ratiometric load cell
 * sensor. It can be used to control the bridge excitation parameters, in order to avoid
 * measure shifts caused by temperature variation in the electronics, and can also
 * automatically apply an additional correction factor based on temperature to
 * compensate for offsets in the load cell itself.
 */
class YWeighScale extends YSensor
{
    const EXCITATION_OFF                 = 0;
    const EXCITATION_DC                  = 1;
    const EXCITATION_AC                  = 2;
    const EXCITATION_INVALID             = -1;
    const ADAPTRATIO_INVALID             = YAPI_INVALID_DOUBLE;
    const COMPTEMPERATURE_INVALID        = YAPI_INVALID_DOUBLE;
    const COMPENSATION_INVALID           = YAPI_INVALID_DOUBLE;
    const ZEROTRACKING_INVALID           = YAPI_INVALID_DOUBLE;
    const COMMAND_INVALID                = YAPI_INVALID_STRING;
    //--- (end of YWeighScale declaration)

    //--- (YWeighScale attributes)
    protected $_excitation               = Y_EXCITATION_INVALID;         // ExcitationMode
    protected $_adaptRatio               = Y_ADAPTRATIO_INVALID;         // MeasureVal
    protected $_compTemperature          = Y_COMPTEMPERATURE_INVALID;    // MeasureVal
    protected $_compensation             = Y_COMPENSATION_INVALID;       // MeasureVal
    protected $_zeroTracking             = Y_ZEROTRACKING_INVALID;       // MeasureVal
    protected $_command                  = Y_COMMAND_INVALID;            // Text
    //--- (end of YWeighScale attributes)

    function __construct($str_func)
    {
        //--- (YWeighScale constructor)
        parent::__construct($str_func);
        $this->_className = 'WeighScale';

        //--- (end of YWeighScale constructor)
    }

    //--- (YWeighScale implementation)

    function _parseAttr($name, $val)
    {
        switch($name) {
        case 'excitation':
            $this->_excitation = intval($val);
            return 1;
        case 'adaptRatio':
            $this->_adaptRatio = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'compTemperature':
            $this->_compTemperature = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'compensation':
            $this->_compensation = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'zeroTracking':
            $this->_zeroTracking = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'command':
            $this->_command = $val;
            return 1;
        }
        return parent::_parseAttr($name, $val);
    }

    /**
     * Returns the current load cell bridge excitation method.
     *
     * @return a value among Y_EXCITATION_OFF, Y_EXCITATION_DC and Y_EXCITATION_AC corresponding to the
     * current load cell bridge excitation method
     *
     * On failure, throws an exception or returns Y_EXCITATION_INVALID.
     */
    public function get_excitation()
    {
        // $res                    is a enumEXCITATIONMODE;
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_EXCITATION_INVALID;
            }
        }
        $res = $this->_excitation;
        return $res;
    }

    /**
     * Changes the current load cell bridge excitation method.
     *
     * @param newval : a value among Y_EXCITATION_OFF, Y_EXCITATION_DC and Y_EXCITATION_AC corresponding
     * to the current load cell bridge excitation method
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_excitation($newval)
    {
        $rest_val = strval($newval);
        return $this->_setAttr("excitation",$rest_val);
    }

    /**
     * Changes the compensation temperature update rate, in percents.
     *
     * @param newval : a floating point number corresponding to the compensation temperature update rate, in percents
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_adaptRatio($newval)
    {
        $rest_val = strval(round($newval * 65536.0));
        return $this->_setAttr("adaptRatio",$rest_val);
    }

    /**
     * Returns the compensation temperature update rate, in percents.
     * the maximal value is 65 percents.
     *
     * @return a floating point number corresponding to the compensation temperature update rate, in percents
     *
     * On failure, throws an exception or returns Y_ADAPTRATIO_INVALID.
     */
    public function get_adaptRatio()
    {
        // $res                    is a double;
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_ADAPTRATIO_INVALID;
            }
        }
        $res = $this->_adaptRatio;
        return $res;
    }

    /**
     * Returns the current compensation temperature.
     *
     * @return a floating point number corresponding to the current compensation temperature
     *
     * On failure, throws an exception or returns Y_COMPTEMPERATURE_INVALID.
     */
    public function get_compTemperature()
    {
        // $res                    is a double;
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_COMPTEMPERATURE_INVALID;
            }
        }
        $res = $this->_compTemperature;
        return $res;
    }

    /**
     * Returns the current current thermal compensation value.
     *
     * @return a floating point number corresponding to the current current thermal compensation value
     *
     * On failure, throws an exception or returns Y_COMPENSATION_INVALID.
     */
    public function get_compensation()
    {
        // $res                    is a double;
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_COMPENSATION_INVALID;
            }
        }
        $res = $this->_compensation;
        return $res;
    }

    /**
     * Changes the compensation temperature update rate, in percents.
     *
     * @param newval : a floating point number corresponding to the compensation temperature update rate, in percents
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_zeroTracking($newval)
    {
        $rest_val = strval(round($newval * 65536.0));
        return $this->_setAttr("zeroTracking",$rest_val);
    }

    /**
     * Returns the zero tracking threshold value. When this threshold is larger than
     * zero, any measure under the threshold will automatically be ignored and the
     * zero compensation will be updated.
     *
     * @return a floating point number corresponding to the zero tracking threshold value
     *
     * On failure, throws an exception or returns Y_ZEROTRACKING_INVALID.
     */
    public function get_zeroTracking()
    {
        // $res                    is a double;
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_ZEROTRACKING_INVALID;
            }
        }
        $res = $this->_zeroTracking;
        return $res;
    }

    public function get_command()
    {
        // $res                    is a string;
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_COMMAND_INVALID;
            }
        }
        $res = $this->_command;
        return $res;
    }

    public function set_command($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("command",$rest_val);
    }

    /**
     * Retrieves a weighing scale sensor for a given identifier.
     * The identifier can be specified using several formats:
     * <ul>
     * <li>FunctionLogicalName</li>
     * <li>ModuleSerialNumber.FunctionIdentifier</li>
     * <li>ModuleSerialNumber.FunctionLogicalName</li>
     * <li>ModuleLogicalName.FunctionIdentifier</li>
     * <li>ModuleLogicalName.FunctionLogicalName</li>
     * </ul>
     *
     * This function does not require that the weighing scale sensor is online at the time
     * it is invoked. The returned object is nevertheless valid.
     * Use the method YWeighScale.isOnline() to test if the weighing scale sensor is
     * indeed online at a given time. In case of ambiguity when looking for
     * a weighing scale sensor by logical name, no error is notified: the first instance
     * found is returned. The search is performed first by hardware name,
     * then by logical name.
     *
     * If a call to this object's is_online() method returns FALSE although
     * you are certain that the matching device is plugged, make sure that you did
     * call registerHub() at application initialization time.
     *
     * @param func : a string that uniquely characterizes the weighing scale sensor
     *
     * @return a YWeighScale object allowing you to drive the weighing scale sensor.
     */
    public static function FindWeighScale($func)
    {
        // $obj                    is a YWeighScale;
        $obj = YFunction::_FindFromCache('WeighScale', $func);
        if ($obj == null) {
            $obj = new YWeighScale($func);
            YFunction::_AddToCache('WeighScale', $func, $obj);
        }
        return $obj;
    }

    /**
     * Adapts the load cell signal bias (stored in the corresponding genericSensor)
     * so that the current signal corresponds to a zero weight.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function tare()
    {
        return $this->set_command('T');
    }

    /**
     * Configures the load cell span parameters (stored in the corresponding genericSensor)
     * so that the current signal corresponds to the specified reference weight.
     *
     * @param currWeight : reference weight presently on the load cell.
     * @param maxWeight : maximum weight to be expectect on the load cell.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function setupSpan($currWeight,$maxWeight)
    {
        return $this->set_command(sprintf('S%d:%d', round(1000*$currWeight), round(1000*$maxWeight)));
    }

    /**
     * Records a weight offset thermal compensation table, in order to automatically correct the
     * measured weight based on the compensation temperature.
     * The weight correction will be applied by linear interpolation between specified points.
     *
     * @param tempValues : array of floating point numbers, corresponding to all
     *         temperatures for which an offset correction is specified.
     * @param compValues : array of floating point numbers, corresponding to the offset correction
     *         to apply for each of the temperature included in the first
     *         argument, index by index.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_offsetCompensationTable($tempValues,$compValues)
    {
        // $siz                    is a int;
        // $res                    is a int;
        // $idx                    is a int;
        // $found                  is a int;
        // $prev                   is a float;
        // $curr                   is a float;
        // $currComp               is a float;
        // $idxTemp                is a float;
        $siz = sizeof($tempValues);
        if (!($siz != 1)) return $this->_throw( YAPI_INVALID_ARGUMENT, 'thermal compensation table must have at least two points',YAPI_INVALID_ARGUMENT);
        if (!($siz == sizeof($compValues))) return $this->_throw( YAPI_INVALID_ARGUMENT, 'table sizes mismatch',YAPI_INVALID_ARGUMENT);

        $res = $this->set_command('2Z');
        if (!($res==YAPI_SUCCESS)) return $this->_throw( YAPI_IO_ERROR, 'unable to reset thermal compensation table',YAPI_IO_ERROR);
        // add records in growing temperature value
        $found = 1;
        $prev = -999999.0;
        while ($found > 0) {
            $found = 0;
            $curr = 99999999.0;
            $currComp = -999999.0;
            $idx = 0;
            while ($idx < $siz) {
                $idxTemp = $tempValues[$idx];
                if (($idxTemp > $prev) && ($idxTemp < $curr)) {
                    $curr = $idxTemp;
                    $currComp = $compValues[$idx];
                    $found = 1;
                }
                $idx = $idx + 1;
            }
            if ($found > 0) {
                $res = $this->set_command(sprintf('2m%d:%d', round(1000*$curr), round(1000*$currComp)));
                if (!($res==YAPI_SUCCESS)) return $this->_throw( YAPI_IO_ERROR, 'unable to set thermal compensation table',YAPI_IO_ERROR);
                $prev = $curr;
            }
        }
        return YAPI_SUCCESS;
    }

    /**
     * Retrieves the weight offset thermal compensation table previously configured using the
     * set_offsetCompensationTable function.
     * The weight correction is applied by linear interpolation between specified points.
     *
     * @param tempValues : array of floating point numbers, that is filled by the function
     *         with all temperatures for which an offset correction is specified.
     * @param compValues : array of floating point numbers, that is filled by the function
     *         with the offset correction applied for each of the temperature
     *         included in the first argument, index by index.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function loadOffsetCompensationTable(&$tempValues,&$compValues)
    {
        // $id                     is a str;
        // $bin_json               is a bin;
        $paramlist = Array();   // strArr;
        // $siz                    is a int;
        // $idx                    is a int;
        // $temp                   is a float;
        // $comp                   is a float;

        $id = $this->get_functionId();
        $id = substr($id,  11, strlen($id) - 11);
        $bin_json = $this->_download('extra.json?page=2');
        $paramlist = $this->_json_get_array($bin_json);
        // convert all values to float and append records
        $siz = ((sizeof($paramlist)) >> (1));
        while(sizeof($tempValues) > 0) { array_pop($tempValues); };
        while(sizeof($compValues) > 0) { array_pop($compValues); };
        $idx = 0;
        while ($idx < $siz) {
            $temp = floatval($paramlist[2*$idx])/1000.0;
            $comp = floatval($paramlist[2*$idx+1])/1000.0;
            $tempValues[] = $temp;
            $compValues[] = $comp;
            $idx = $idx + 1;
        }
        return YAPI_SUCCESS;
    }

    /**
     * Records a weight span thermal compensation table, in order to automatically correct the
     * measured weight based on the compensation temperature.
     * The weight correction will be applied by linear interpolation between specified points.
     *
     * @param tempValues : array of floating point numbers, corresponding to all
     *         temperatures for which a span correction is specified.
     * @param compValues : array of floating point numbers, corresponding to the span correction
     *         (in percents) to apply for each of the temperature included in the first
     *         argument, index by index.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_spanCompensationTable($tempValues,$compValues)
    {
        // $siz                    is a int;
        // $res                    is a int;
        // $idx                    is a int;
        // $found                  is a int;
        // $prev                   is a float;
        // $curr                   is a float;
        // $currComp               is a float;
        // $idxTemp                is a float;
        $siz = sizeof($tempValues);
        if (!($siz != 1)) return $this->_throw( YAPI_INVALID_ARGUMENT, 'thermal compensation table must have at least two points',YAPI_INVALID_ARGUMENT);
        if (!($siz == sizeof($compValues))) return $this->_throw( YAPI_INVALID_ARGUMENT, 'table sizes mismatch',YAPI_INVALID_ARGUMENT);

        $res = $this->set_command('3Z');
        if (!($res==YAPI_SUCCESS)) return $this->_throw( YAPI_IO_ERROR, 'unable to reset thermal compensation table',YAPI_IO_ERROR);
        // add records in growing temperature value
        $found = 1;
        $prev = -999999.0;
        while ($found > 0) {
            $found = 0;
            $curr = 99999999.0;
            $currComp = -999999.0;
            $idx = 0;
            while ($idx < $siz) {
                $idxTemp = $tempValues[$idx];
                if (($idxTemp > $prev) && ($idxTemp < $curr)) {
                    $curr = $idxTemp;
                    $currComp = $compValues[$idx];
                    $found = 1;
                }
                $idx = $idx + 1;
            }
            if ($found > 0) {
                $res = $this->set_command(sprintf('3m%d:%d', round(1000*$curr), round(1000*$currComp)));
                if (!($res==YAPI_SUCCESS)) return $this->_throw( YAPI_IO_ERROR, 'unable to set thermal compensation table',YAPI_IO_ERROR);
                $prev = $curr;
            }
        }
        return YAPI_SUCCESS;
    }

    /**
     * Retrieves the weight span thermal compensation table previously configured using the
     * set_spanCompensationTable function.
     * The weight correction is applied by linear interpolation between specified points.
     *
     * @param tempValues : array of floating point numbers, that is filled by the function
     *         with all temperatures for which an span correction is specified.
     * @param compValues : array of floating point numbers, that is filled by the function
     *         with the span correction applied for each of the temperature
     *         included in the first argument, index by index.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function loadSpanCompensationTable(&$tempValues,&$compValues)
    {
        // $id                     is a str;
        // $bin_json               is a bin;
        $paramlist = Array();   // strArr;
        // $siz                    is a int;
        // $idx                    is a int;
        // $temp                   is a float;
        // $comp                   is a float;

        $id = $this->get_functionId();
        $id = substr($id,  11, strlen($id) - 11);
        $bin_json = $this->_download('extra.json?page=3');
        $paramlist = $this->_json_get_array($bin_json);
        // convert all values to float and append records
        $siz = ((sizeof($paramlist)) >> (1));
        while(sizeof($tempValues) > 0) { array_pop($tempValues); };
        while(sizeof($compValues) > 0) { array_pop($compValues); };
        $idx = 0;
        while ($idx < $siz) {
            $temp = floatval($paramlist[2*$idx])/1000.0;
            $comp = floatval($paramlist[2*$idx+1])/1000.0;
            $tempValues[] = $temp;
            $compValues[] = $comp;
            $idx = $idx + 1;
        }
        return YAPI_SUCCESS;
    }

    public function excitation()
    { return $this->get_excitation(); }

    public function setExcitation($newval)
    { return $this->set_excitation($newval); }

    public function setAdaptRatio($newval)
    { return $this->set_adaptRatio($newval); }

    public function adaptRatio()
    { return $this->get_adaptRatio(); }

    public function compTemperature()
    { return $this->get_compTemperature(); }

    public function compensation()
    { return $this->get_compensation(); }

    public function setZeroTracking($newval)
    { return $this->set_zeroTracking($newval); }

    public function zeroTracking()
    { return $this->get_zeroTracking(); }

    public function command()
    { return $this->get_command(); }

    public function setCommand($newval)
    { return $this->set_command($newval); }

    /**
     * Continues the enumeration of weighing scale sensors started using yFirstWeighScale().
     *
     * @return a pointer to a YWeighScale object, corresponding to
     *         a weighing scale sensor currently online, or a null pointer
     *         if there are no more weighing scale sensors to enumerate.
     */
    public function nextWeighScale()
    {   $resolve = YAPI::resolveFunction($this->_className, $this->_func);
        if($resolve->errorType != YAPI_SUCCESS) return null;
        $next_hwid = YAPI::getNextHardwareId($this->_className, $resolve->result);
        if($next_hwid == null) return null;
        return self::FindWeighScale($next_hwid);
    }

    /**
     * Starts the enumeration of weighing scale sensors currently accessible.
     * Use the method YWeighScale.nextWeighScale() to iterate on
     * next weighing scale sensors.
     *
     * @return a pointer to a YWeighScale object, corresponding to
     *         the first weighing scale sensor currently online, or a null pointer
     *         if there are none.
     */
    public static function FirstWeighScale()
    {   $next_hwid = YAPI::getFirstHardwareId('WeighScale');
        if($next_hwid == null) return null;
        return self::FindWeighScale($next_hwid);
    }

    //--- (end of YWeighScale implementation)

};

//--- (WeighScale functions)

/**
 * Retrieves a weighing scale sensor for a given identifier.
 * The identifier can be specified using several formats:
 * <ul>
 * <li>FunctionLogicalName</li>
 * <li>ModuleSerialNumber.FunctionIdentifier</li>
 * <li>ModuleSerialNumber.FunctionLogicalName</li>
 * <li>ModuleLogicalName.FunctionIdentifier</li>
 * <li>ModuleLogicalName.FunctionLogicalName</li>
 * </ul>
 *
 * This function does not require that the weighing scale sensor is online at the time
 * it is invoked. The returned object is nevertheless valid.
 * Use the method YWeighScale.isOnline() to test if the weighing scale sensor is
 * indeed online at a given time. In case of ambiguity when looking for
 * a weighing scale sensor by logical name, no error is notified: the first instance
 * found is returned. The search is performed first by hardware name,
 * then by logical name.
 *
 * If a call to this object's is_online() method returns FALSE although
 * you are certain that the matching device is plugged, make sure that you did
 * call registerHub() at application initialization time.
 *
 * @param func : a string that uniquely characterizes the weighing scale sensor
 *
 * @return a YWeighScale object allowing you to drive the weighing scale sensor.
 */
function yFindWeighScale($func)
{
    return YWeighScale::FindWeighScale($func);
}

/**
 * Starts the enumeration of weighing scale sensors currently accessible.
 * Use the method YWeighScale.nextWeighScale() to iterate on
 * next weighing scale sensors.
 *
 * @return a pointer to a YWeighScale object, corresponding to
 *         the first weighing scale sensor currently online, or a null pointer
 *         if there are none.
 */
function yFirstWeighScale()
{
    return YWeighScale::FirstWeighScale();
}

//--- (end of WeighScale functions)
?>