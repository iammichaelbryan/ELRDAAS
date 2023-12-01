import java.util.ArrayList;

public class Resident extends User{
    ArrayList<Request> request_history = new ArrayList<Request>();
    ArrayList<Request> request_pending = new ArrayList<Request>();
    ELRTowersDomesticAffairsSystem system;
    ArrayList<Appointment> appointments = new ArrayList<Appointment>();
    Laundromat laundromat;
    boolean requestAssigned = false;
    int Tower;

    public Resident (String fname,String lname, String email, int Tower){
        super(fname, lname, email, "Resident");
        
    }
    public int getTower(){
        return Tower;
    }
    public String getStringTower(){
        return "Tower: " + Tower;
    }
    public void makeRequest(Request request){
        request_pending.add(request);
        system.assignRequestToAdmin();
        requestAssigned = true;
    }
    public void cancelRequest(Request request){
        request_pending.remove(request);
    }
    public void viewRequestHistory(){
        for (Request request : request_history){
            System.out.println(request);
        }
    }
    public void viewPendingRequests(){
        for (Request request : request_pending){
            System.out.println(request);
        }
}
public void make_appointment(Appointment appointment){
    appointments.add(appointment);
}
public void view_appointments(){
    for (Appointment appointment : appointments){
        System.out.println(appointment);
    }
}
public void view_available_times(){
    for (String time : laundromat.get_hoursOfOperation()){
        System.out.println(time);
    }
}
public void view_available_days(){
    for (String day : laundromat.get_daysOfOperation()){
        System.out.println(day);
    }
}
public void cancel_appointment(Appointment appointment){
    appointments.remove(appointment);
}

public boolean isRequestAssigned() {
    return requestAssigned;
}
}

