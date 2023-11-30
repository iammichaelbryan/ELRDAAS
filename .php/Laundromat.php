<?php

class Laundromat {
    private $daysOfOperation = [];
    private $hoursOfOperation = [];
    private $appointments = [];

    public function setDaysOfOperation($daysOfOperation) {
        $this->daysOfOperation = $daysOfOperation;
    }

    public function getDaysOfOperation() {
        return $this->daysOfOperation;
    }

    public function setHoursOfOperation($hoursOfOperation) {
        $this->hoursOfOperation = $hoursOfOperation;
    }

    public function getHoursOfOperation() {
        return $this->hoursOfOperation;
    }

    public function addAppointment($appointment) {
        $this->appointments[] = $appointment;
    }

    public function removeAppointment($appointment) {
        $key = array_search($appointment, $this->appointments);
        if ($key !== false) {
            unset($this->appointments[$key]);
        }
    }

    // You can uncomment and implement the getAvailableTimes method if needed
    /*
    public function getAvailableTimes() {
        // Placeholder logic for getting available times
    }
    */
}

?>
