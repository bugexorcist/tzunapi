<?php
/**
 * Holds carrier-related service class
 * 
 * @author Anton Matiyenko <amatiyenko@gmail.com>
 * 
 * @ignore
 */

namespace Services_0_1;

/**
 * Service class holds all carrier-related opearation.
 * All operations are run from the command line
 * 
 * @ignore
 */
class Carriers extends \Services_0_1\BaseService {
    
    /**
     * Creates new Carrier entry
     * 
     * @param string $title
     * @param string $request_method
     * 
     * @return \stdObject
     * 
     * @throws \NoAccessException
     * @throws \MissingParameterException
     * @throws \WrongParametersException
     */
    public static function add($title = false, $request_method = false) {
        //Block maintenance from access as regular API service
        if($request_method !== 'CLI') {
            throw \ExceptionHandler::noAccessException(__('Maintenance console is not accessible this way.'));
        }
        if(!$title) {
            throw \ExceptionHandler::missingParameterException(__('You must specify title to add new carrier'));
        }
        if($existingCarrier = \DS::getEntityManager()->getRepository('Entities\Carrier')->findOneByTitle($title)) {
            throw \ExceptionHandler::wrongParametersException(__('This carrier already exists in the database.'));
        } else {
            $carrier = new \Entities\Carrier();
            $carrier->setTitle($title);
            $carrier->setActive(1);
            \DS::getEntityManager()->persist($carrier);
            \DS::getEntityManager()->flush();
            $response = new \stdClass();
            $response->message = __('New carrier "' . $title . '" has been created. The ID is:' . $carrier->getId());
            $response->new_carrier_id = $carrier->getId();
        }
        return $response;
    }
    
    /**
     * Disables existing carrier
     * 
     * @param string|integer $carrier title or ID of carrier
     * @param string $request_method
     * 
     * @return \stdClass
     * 
     * @throws \NoAccessException
     * @throws \MissingParameterException
     * @throws \WrongParametersException
     */
    public static function disable($carrier = false, $request_method = false) {
        //Block maintenance from access as regular API service
        if($request_method !== 'CLI') {
            throw \ExceptionHandler::noAccessException(__('Maintenance console is not accessible this way.'));
        }
        
        if(isValueNumeric($carrier)) {
            $existingCarrier = \DS::getEntityManager()->getRepository('\Entities\Carrier')->find($carrier);
        } else {
            $existingCarrier = \DS::getEntityManager()->getRepository('\Entities\Carrier')->findOneByTitle($carrier);
        }
        
        if($existingCarrier) {
            $existingCarrier->setActive(0);
            \DS::getEntityManager()->persist($existingCarrier);
            \DS::getEntityManager()->flush();
            $response = new \stdClass();
            $response->message = __('Carrier "' . $existingCarrier->getTitle() . '" has been disabled.');
        } else {
            throw \ExceptionHandler::wrongParametersException(__('This carrier is not found in the database.'));
        }
        
        return $response;
    }
    
    /**
     * Enables existing carrier
     * 
     * @param string|integer $carrier title or ID of carrier
     * @param string $request_method
     * 
     * @return \stdClass
     * 
     * @throws \NoAccessException
     * @throws \WrongParametersException
     * @throws \MissingParameterException
     */
    public static function enable($carrier = false, $request_method = false) {
        //Block maintenance from access as regular API service
        if($request_method !== 'CLI') {
            throw \ExceptionHandler::noAccessException(__('Maintenance console is not accessible this way.'));
        }
        
        if(isValueNumeric($carrier)) {
            $existingCarrier = \DS::getEntityManager()->getRepository('\Entities\Carrier')->find($carrier);
        } else {
            $existingCarrier = \DS::getEntityManager()->getRepository('\Entities\Carrier')->findOneByTitle($carrier);
        }
        
        if($existingCarrier) {
            $existingCarrier->setActive(1);
            \DS::getEntityManager()->persist($existingCarrier);
            \DS::getEntityManager()->flush();
            $response = new \stdClass();
            $response->message = __('Carrier "' . $existingCarrier->getTitle() . '" has been activated.');
        } else {
            throw \ExceptionHandler::wrongParametersException(__('This carrier is not found in the database.'));
        }
        
        return $response;
    }

}
