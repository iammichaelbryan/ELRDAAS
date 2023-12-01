public class Appointment {
    User user;
    String date;
    String time;
    String[] serviceTypes;

    public Appointment(User user, String date, String time, String[] serviceTypes) {
        this.user = user;
        this.date = date;
        this.time = time;
        this.serviceTypes = serviceTypes;
    }

    // Getters and setters

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public String[] getServiceTypes() {
        return serviceTypes;
    }

    public void setServiceTypes(String[] serviceTypes) {
        this.serviceTypes = serviceTypes;
    }
    public boolean validateAppointment() {
        return false; // Placeholder return statement
    }

    // Time slot checking method (pass)
    public boolean checkAvailability(Laundromat laundromat) {
        return false; // Placeholder return statement
    }

    // Formatting method (pass)
    public String formatAppointmentDetails() {
        return ""; // Placeholder return statement
    }

    // Service type handling methods (pass)
    public void addServiceType(String serviceType) {
        // Placeholder method with no functionality
    }

    public void removeServiceType(String serviceType) {
        // Placeholder method with no functionality
    }

}
