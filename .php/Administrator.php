<?php

class Administrator extends User {
    private $system;
    private $requestsAssigned = [];
    private $requestsResolved = [];

    public function __construct($fname, $lname, $email) {
        parent::__construct($fname, $lname, $email, "Administrator");
    }

    public function assignRequest($request) {
        if (!$this->system->isRequestAssigned()) {
            $this->system->assignRequestToAdmin();
        }
        $this->requestsAssigned[] = $request;
    }

    public function viewRequestsAssigned() {
        foreach ($this->requestsAssigned as $request) {
            echo $request . "<br>";
        }
    }

    public function viewRequestsResolved() {
        foreach ($this->requestsResolved as $request) {
            echo $request . "<br>";
        }
    }

    public function assignPriority($request) {
        // Add your logic here
    }

    public function sendStatusUpdate() {
        // Add your logic here
    }

    public function resolveRequest($request) {
        $request->setRequestResolved(true);
        $this->requestsResolved[] = $request;
        $index = array_search($request, $this->requestsAssigned);
        if ($index !== false) {
            unset($this->requestsAssigned[$index]);
        }
        $this->system->sendRequestStatusUpdate();
    }
}

?>
