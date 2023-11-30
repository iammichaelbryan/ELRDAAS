<?php

class Appointment {
    private $user;
    private $date;
    private $time;
    private $serviceTypes;

    public function __construct($user, $date, $time, $serviceTypes) {
        $this->user = $user;
        $this->date = $date;
        $this->time = $time;
        $this->serviceTypes = $serviceTypes;
    }

    // Getters and setters

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function getServiceTypes() {
        return $this->serviceTypes;
    }

    public function setServiceTypes($serviceTypes) {
        $this->serviceTypes = $serviceTypes;
    }

    public function validateAppointment() {
        return false; // Placeholder return statement
    }

    public function checkAvailability($laundromat) {
        return false; // Placeholder return statement
    }

    public function formatAppointmentDetails() {
        return ""; // Placeholder return statement
    }

    public function addServiceType($serviceType) {
        // Placeholder method with no functionality
    }

    public function removeServiceType($serviceType) {
        // Placeholder method with no functionality
    }
}

?>
