public class Request {

    String date;
    String time;
    String requestType;
    String requestDescription;
    String requestStatus;
    static int requestID;
    String requestPriority;
    String requestLocation;
    Resident resident;
    Administrator assignedAdmin;
    ELRTowersDomesticAffairsSystem system;
    boolean requestAssigned = false;
    boolean request_resolved = false;

    public Request(Resident resident, String date, String time, String requestType, String requestDescription, String requestLocation) {
        this.date = date;
        this.time = time;
        this.requestType = requestType;
        this.requestDescription = requestDescription;
        //assignedAdmin = system.assignRequestToAdmin();
        this.requestLocation = "Tower: " + resident.getStringTower();
        this.resident = resident;
        requestStatus = "Pending";
        system.add_request(this);
    }

    public static int generateRequestID() {
        return requestID++;
    } 
    public void getRequestAssigned(){
        assignedAdmin = system.assignRequestToAdmin();
        requestStatus = "Assigned to Admin";
        requestAssigned = true;
    }
    
}
