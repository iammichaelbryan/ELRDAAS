import java.util.ArrayList;


public class ELRTowersDomesticAffairsSystem{
    
    int [] Towers = {1,2,3,4,5}} 
    ArrayList<Resident> Residents = new ArrayList<Resident>();
    ArrayList<Administrator> Administrators = new ArrayList<Administrator>();
    ArrayList<Request> Requests = new ArrayList<Request>();
    ArrayList<Notice> Notices = new ArrayList<Notice>();

   
    public void add_resident(Resident resident){
        Residents.add(resident);
    }
    public void remove_resident(Resident resident){
        Residents.remove(resident);
    }
    public void add_administrator(Administrator administrator){
        Administrators.add(administrator);
    }
    public void remove_administrator(Administrator administrator){
        Administrators.remove(administrator);
    }
    
    public void sendAppointmentReminder(){
        continue;
    }
    public void sendAppointmentConfirmation(){
        continue;
    }
    public Administrator assignRequestToAdmin(){
        continue;
    }
    public boolean isRequestAssigned(){
        continue;
    }
    public void sendRequestStatusUpdate(){
        continue;
    }
    public void add_request(Request request){
        Requests.add(request);
    }
    public void add_notice(Notice notice){
        Notices.add(notice);
        continue;
    }
    public void remove_notice(Notice notice){
        Notices.remove(notice);
        continue;
    }
}
    


