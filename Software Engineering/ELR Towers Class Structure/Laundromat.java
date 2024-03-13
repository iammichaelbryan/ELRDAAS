import java.util.ArrayList;

public class Laundromat {
    ArrayList<String> daysOfOperation = new ArrayList<String>();
    ArrayList<String> hoursOfOperation = new ArrayList<String>();

    ArrayList<Appointment> appointments = new ArrayList<Appointment>();


   

    public void set_daysOfOperation(ArrayList<String> daysOfOperation){
        this.daysOfOperation = daysOfOperation;
    }
    public ArrayList<String> get_daysOfOperation(){
        return daysOfOperation;
    }
    public void set_hoursOfOperation(ArrayList<String> hoursOfOperation){
        this.hoursOfOperation = hoursOfOperation;
    }
    public ArrayList<String> get_hoursOfOperation(){
        return hoursOfOperation;
    }

     public void add_appointment(Appointment appointment){
        appointments.add(appointment);
    }

    public void remove_appointment(Appointment appointment){
        appointments.remove(appointment);
    }
    /*public ArrayList getAvailableTimes(){
        
    
    }
    */
}