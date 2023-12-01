<?php

class Resident extends User {

    private $request_history = array();
    private $request_pending = array();
    private $system;
    private $appointments = array();
    private $laundromat;
    private $requestAssigned = false;
    private $Tower;

    public function __construct($fname, $lname, $email, $Tower) {
        parent::__construct($fname, $lname, $email, "Resident");
        $this->Tower = $Tower;
    }

    public function getTower() {
        return $this->Tower;
    }

    public function getStringTower() {
        return "Tower: " . $this->Tower;
    }

    public function makeRequest($request) {
        $this->request_pending[] = $request;
        $this->system->assignRequestToAdmin();
        $this->requestAssigned = true;
    }

    public function cancelRequest($request) {
        $key = array_search($request, $this->request_pending);
        if ($key !== false) {
            unset($this->request_pending[$key]);
        }
    }

    public function viewRequestHistory() {
        foreach ($this->request_history as $request) {
            echo $request . "\n";
        }
    }

    public function viewPendingRequests() {
        foreach ($this->request_pending as $request) {
            echo $request . "\n";
        }
    }

    public function makeAppointment($appointment) {
        $this->appointments[] = $appointment;
    }

    public function viewAppointments() {
        foreach ($this->appointments as $appointment) {
            echo $appointment . "\n";
        }
    }

    public function viewAvailableTimes() {
        foreach ($this->laundromat->get_hoursOfOperation() as $time) {
            echo $time . "\n";
        }
    }

    public function viewAvailableDays() {
        foreach ($this->laundromat->get_daysOfOperation() as $day) {
            echo $day . "\n";
        }
    }

    public function cancelAppointment($appointment) {
        $key = array_search($appointment, $this->appointments);
        if ($key !== false) {
            unset($this->appointments[$key]);
        }
    }

    public function isRequestAssigned() {
        return $this->requestAssigned;
    }
}

?>
