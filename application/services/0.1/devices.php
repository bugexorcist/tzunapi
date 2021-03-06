<?php

namespace Services_0_1;

/**
 * Service for device-related opearations: device can be added (create()) and polled (read()).
 */
class Devices extends \Services_0_1\BaseService {

    /**
     * Creates new device or returns existing device with appropriate ESN
     * 
     * @param string $esn ESN of a device to add
     * @param integer $user_id userId of API user current request is authorized for
     * @param boolean $sealed specifies is request is properly authorized: data contains verified signature
     * @return \Entities\Device
     * 
     * @throws \MissingParameterException
     * @throws \NoAccessException
     */
    public static function create($esn = false, $user_id = false, $sealed = false) {
        if(!$esn) {
            throw \ExceptionHandler::missingParameterException(__('You must specify ESN to add new device'));
        }
        if(!$user_id) {
            throw \ExceptionHandler::missingParameterException(__('You must specify User ID to add new device'));
        }
        //Check if request was properly signed and is authorized
        if($sealed) {
            //Check if device with such ESN already exists
            if(!$device = self::read($esn, $user_id, $sealed)) {
                //Create new device otherwise
                $device  = new \Entities\Device();
                $device->setUserId((int)$user_id);
                $device->setEsn($esn);
                \DS::getEntityManager()->persist($device);
                \DS::getEntityManager()->flush();
            }
        } else {
            throw \ExceptionHandler::noAccessException(__('Access not allowed'));
        }
        
        return $device;
    }
    
    /**
     * Finds a device with specified ESN for currently authorized user
     * 
     * @param string $esn ESN of a device to search for
     * @param integer $user_id userId of API user current request is authorized for
     * @param boolean $sealed specifies is request is properly authorized: data contains verified signature
     * @return \Entities\Device
     */
    public static function read($esn = false, $user_id = false, $sealed = false) {
        if($existingDevices = \DS::getEntityManager()->getRepository('Entities\Device')->findBy(array('esn' => $esn, 'userId' => (int)$user_id))) {
            return $existingDevices[0];
        }
        return null;
    }

}