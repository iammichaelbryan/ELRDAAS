import java.lang.reflect.Array;
import java.util.ArrayList;

public class Administrator extends User{
    ELRTowersDomesticAffairsSystem system;


        ArrayList<Request> requestsassigned = new ArrayList<Request>();
        ArrayList<Request> request_resolved = new ArrayList<Request>();

        public Administrator(String fname, String lname, String email){
            super(fname, lname, email, "Administrator");
        }
        public void assignRequest(Request request){
            for (Request r : requestsassigned){
                if(system.isRequestAssigned() == false){
                    system.assignRequestToAdmin();
                }
            requestsassigned.add(request);
        }
    }

        public void viewRequestsAssigned(){
            for (Request request : requestsassigned){
                System.out.println(request);
            }
        }


        public void viewRequestsResolved(){
            for (Request request : request_resolved){
                System.out.println(request);
            }
        }
        public void assign_priority(Request request){
           // continue;
        }
        public void sendStatusUpdate(){
            
        }

        public void resolveRequest(Request request){
            request. request_resolved = true;
            request_resolved.add(request);
            requestsassigned.remove(request);
            system.sendRequestStatusUpdate();
        }
        public void postNotice(Notice n){
            //placeholder, implementation to be given
        }

}
