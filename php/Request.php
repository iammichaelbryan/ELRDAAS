<?php

class Request {

    private $date;
    private $time;
    private $requestType;
    private $requestDescription;
    private $requestStatus;
    private static $requestID = 1;
    private $requestPriority;
    private $requestLocation;
    private $resident;
    private $assignedAdmin;
    private $system;
    private $requestAssigned = false;
    private $requestResolved = false;

    public function __construct($resident, $date, $time, $requestType, $requestDescription, $requestLocation) {
        $this->date = $date;
        $this->time = $time;
        $this->requestType = $requestType;
        $this->requestDescription = $requestDescription;
        $this->requestLocation = "Tower: " . $resident->getStringTower();
        $this->resident = $resident;
        $this->requestStatus = "Pending";
        $this->system->add_request($this);
    }

    public static function generateRequestID() {
        return self::$requestID++;
    }

    public function getRequestAssigned() {
        $this->assignedAdmin = $this->system->assignRequestToAdmin();
        $this->requestStatus = "Assigned to Admin";
        $this->requestAssigned = true;
    }
    
}

?>
